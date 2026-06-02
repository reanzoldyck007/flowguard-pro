// ============================================================
//  FlowGuard Pro – ESP32 Sensor Logger
//  Sensors: DS18B20 (temp) | MQ135 (ammonia proxy) |
//           ACS712 (current/UPS) | Turbidity
//  Posts to: /flowguard/api/post-data.php every ~2 seconds
// ============================================================

#include <OneWire.h>
#include <DallasTemperature.h>
#include <WiFi.h>
#include <HTTPClient.h>

// ── Pin Definitions ──────────────────────────────────────────
#define TURBIDITY_PIN       34
#define MQ135_PIN           36
#define ACS712_PIN          33
#define DS18B20_PIN         16
#define RELAY_PIN           26

// ── Constants ────────────────────────────────────────────────
#define VREF                3.3
#define ADC_RESOLUTION      4095
#define ACS712_SENSITIVITY  0.185   // V/A for ACS712-05B
#define ACS712_SAMPLES      500
#define READ_INTERVAL       2000    // ms between full loop cycles
#define CURRENT_THRESHOLD   0.10    // A — below this = no mains power

// ── WiFi & Server ────────────────────────────────────────────
const char* ssid       = "STARLINK2.4G";
const char* password   = "Jesuschrist2025";
const char* serverName = "http://192.168.100.14/flowguard/api/post-data.php";
String      apiKey     = "t74B6554as89";

// ── DS18B20 Setup ────────────────────────────────────────────
OneWire          oneWire(DS18B20_PIN);
DallasTemperature sensors(&oneWire);

// ── ACS712: True RMS Current ─────────────────────────────────
float readCurrentRMS() {
  // Step 1: find zero-current midpoint
  long sum = 0;
  for (int i = 0; i < 500; i++) sum += analogRead(ACS712_PIN);
  int zeroPoint = sum / 500;

  // Step 2: compute RMS
  float squareSum = 0;
  for (int i = 0; i < ACS712_SAMPLES; i++) {
    int   raw     = analogRead(ACS712_PIN);
    float voltage = (raw - zeroPoint) * (VREF / ADC_RESOLUTION);
    float current = voltage / ACS712_SENSITIVITY;
    squareSum    += current * current;
  }
  return sqrt(squareSum / ACS712_SAMPLES);
}

// ── Setup ─────────────────────────────────────────────────────
void setup() {
  Serial.begin(115200);
  delay(500);

  sensors.begin();
  pinMode(RELAY_PIN, OUTPUT);
  digitalWrite(RELAY_PIN, LOW);

  Serial.println("=== FlowGuard Pro – ESP32 Started ===");
  Serial.println("Warming up sensors (3s)...");
  delay(3000);
  Serial.println("Ready!\n");

  // WiFi connect
  Serial.print("Connecting to WiFi: ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  int retry = 0;
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    if (++retry > 20) {
      Serial.println("\n❌ WiFi Connection Failed! Will retry in loop.");
      break;
    }
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\n✅ WiFi Connected!");
    Serial.print("IP: ");   Serial.println(WiFi.localIP());
    Serial.print("RSSI: "); Serial.print(WiFi.RSSI()); Serial.println(" dBm");
  }
}

// ── Main Loop ─────────────────────────────────────────────────
void loop() {

  // ── 1. Turbidity (SEN0189 / analog) ─────────────────────────
  // Formula: NTU = -1120.4*V² + 5742.3*V - 4352.9  (empirical)
  int   rawTurbidity  = analogRead(TURBIDITY_PIN);
  float voltTurbidity = rawTurbidity * (VREF / ADC_RESOLUTION);
  float ntu           = -1120.4 * sq(voltTurbidity) + 5742.3 * voltTurbidity - 4352.9;
  if (ntu < 0) ntu    = 0;

  // ── 2. MQ135 – Ammonia proxy ─────────────────────────────────
  // ⚠ NOTE: rawMQ135/1000 is a LINEAR approximation (0–4095 → 0–4.095).
  //   For accurate ppm you need: Rs/R0 calibration + gas curve.
  //   Replace with your calibrated formula when sensor is burned-in (24h).
  int   rawMQ135 = analogRead(MQ135_PIN);
  float ammonia  = rawMQ135 / 1000.0;   // rough ppm proxy

  // ── 3. DS18B20 – Water Temperature ───────────────────────────
  sensors.requestTemperatures();
  float tempC = sensors.getTempCByIndex(0);

  // Guard: -127 means sensor is disconnected / not found
  bool tempValid = (tempC > -100.0);
  if (!tempValid) {
    Serial.println("⚠ DS18B20 ERROR – Check wiring on pin 16!");
  }

  // ── 4. ACS712 – Current → UPS/Mains detection ────────────────
  // ⚠ NOTE: oxygen is NOT measured by a physical sensor yet.
  //   It is fixed at 8.0 mg/L (typical well-oxygenated water).
  //   Add a DO sensor (e.g. Atlas Scientific EZO-DO) to replace this.
  float currentA    = readCurrentRMS();
  float oxygenProxy = 8.0;   // TODO: replace with real DO sensor reading

  // ── 5. UPS Relay Logic ────────────────────────────────────────
  bool powerSupplyON = (currentA >= CURRENT_THRESHOLD);
  digitalWrite(RELAY_PIN, powerSupplyON ? LOW : HIGH);

  // Derive fields for POST
  String pump    = powerSupplyON ? "ON"      : "OFF";
  String power   = powerSupplyON ? "MAIN"    : "BATTERY";
  // ⚠ battery% is estimated — add a voltage divider on the LiPo to measure real %.
  int    battery = powerSupplyON ? 100       : 75;

  // ── Serial Debug ─────────────────────────────────────────────
  Serial.println("========================================");
  Serial.printf("Turbidity : %.2f NTU  (raw=%d, V=%.3f)\n", ntu, rawTurbidity, voltTurbidity);
  Serial.printf("MQ135 Raw : %d  → ammonia proxy: %.3f ppm\n", rawMQ135, ammonia);
  Serial.printf("Temp      : %s\n", tempValid ? (String(tempC, 2) + " °C").c_str() : "ERROR");
  Serial.printf("Current   : %.3f A  |  Est. Power: %.2f W\n", currentA, currentA * 220.0);
  Serial.printf("Power Src : %s  |  Relay: %s\n", power.c_str(), powerSupplyON ? "OFF (mains)" : "ON (battery)");
  Serial.println("========================================");

  // ── HTTP POST to Server ───────────────────────────────────────
  if (WiFi.status() == WL_CONNECTED) {

    HTTPClient http;
    http.begin(serverName);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int    wifiRSSI = WiFi.RSSI();
    String espIP    = WiFi.localIP().toString();

    // Send tempC only if valid; send -127 flag if disconnected so DB can mark INACTIVE
    String postData =
        "api_key="  + apiKey                         +
        "&temp="    + String(tempValid ? tempC : -127.0, 2) +
        "&ammonia=" + String(ammonia, 3)             +
        "&oxygen="  + String(oxygenProxy, 1)         +
        "&turbidity=" + String(ntu, 2)               +   // ✅ NOW SENT
        "&pump="    + pump                           +
        "&power="   + power                          +
        "&battery=" + String(battery)                +
        "&wifi="    + String(wifiRSSI)               +
        "&ip="      + espIP;

    int    httpCode  = http.POST(postData);
    String response  = http.getString();

    Serial.println("=== SERVER RESPONSE ===");
    Serial.printf("HTTP Code : %d\n", httpCode);
    Serial.println(response);

    if (httpCode == 200 && response.indexOf("\"status\":\"success\"") >= 0) {
      Serial.println(response.indexOf("\"rows_affected\":0") >= 0
        ? "⚠ SUCCESS but NO DATA CHANGE"
        : "✅ DATABASE UPDATED");
    } else {
      Serial.println("❌ POST FAILED");
    }
    Serial.println("========================\n");

    http.end();

  } else {
    Serial.println("⚠ WiFi disconnected — attempting reconnect...");
    WiFi.reconnect();
  }

  delay(READ_INTERVAL);
}
