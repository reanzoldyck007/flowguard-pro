<?php
header('Content-Type: application/json');

$servername    = "localhost";
$username      = "root";
$password      = "";
$dbname        = "flowguard";
$api_key_value = "t74B6554as89";

function respond($status, $message, $extra = []) {
    echo json_encode(array_merge([
        "status"    => $status,
        "message"   => $message,
        "timestamp" => date("Y-m-d H:i:s")
    ], $extra));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    respond("error", "No POST request received");
}

$api_key = $_POST["api_key"] ?? "";
if ($api_key !== $api_key_value) {
    respond("error", "Invalid API Key");
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    respond("error", "DB connection failed: " . $conn->connect_error);
}

// Raw fields from ESP32
$temp      = $conn->real_escape_string($_POST["temp"]      ?? 0);
$ammonia   = $conn->real_escape_string($_POST["ammonia"]   ?? 0);
$oxygen    = $conn->real_escape_string($_POST["oxygen"]    ?? 0);
$turbidity = $conn->real_escape_string($_POST["turbidity"] ?? 0);
$pump      = $conn->real_escape_string($_POST["pump"]      ?? "OFF");
$power     = $conn->real_escape_string($_POST["power"]     ?? "MAIN");
$battery   = $conn->real_escape_string($_POST["battery"]   ?? 0);
$wifi      = $conn->real_escape_string($_POST["wifi"]      ?? 0);
$ip        = $conn->real_escape_string($_POST["ip"]        ?? "0.0.0.0");

// Derived
$health         = max(0, min(100, 100 - ($ammonia * 10)));
$sensor_status  = ((float)$temp > -100) ? 'ACTIVE' : 'INACTIVE';
$wifi_connected = ((int)$wifi < 0) ? 1 : 0;
$ups_status     = ((int)$battery >= 50 || $power === 'MAIN') ? 'HEALTHY' : 'UNHEALTHY';
$now            = date("Y-m-d H:i:s");

// 1. tank_telemetry
$sql1 = "UPDATE tank_telemetry SET
            water_temp      = '$temp',
            ammonia         = '$ammonia',
            oxygen          = '$oxygen',
            turbidity_ntu   = '$turbidity',
            pump_status     = '$pump',
            power_source    = '$power',
            battery_level   = '$battery',
            health_score    = '$health',
            wifi_signal_dbm = '$wifi',
            esp_ip          = '$ip'
          WHERE id = 1";

// 2. device_status
$sql2 = "UPDATE device_status SET
            wifi_connected   = '$wifi_connected',
            wifi_signal_dbm  = '$wifi',
            esp_ip           = '$ip',
            sensor_status    = '$sensor_status',
            last_calibration = '$now',
            ups_status       = '$ups_status',
            battery_level    = '$battery',
            power_source     = '$power'
          WHERE id = 1";

$ok1 = $conn->query($sql1);
$ok2 = $conn->query($sql2);

if ($ok1 && $ok2) {
    respond("success", "Both tables updated", [
        "rows_affected" => $conn->affected_rows,
        "posted" => compact("temp","ammonia","oxygen","turbidity","pump","power","battery","wifi","ip")
    ]);
} else {
    respond("error", "SQL Error: " . $conn->error);
}

$conn->close();
?>
