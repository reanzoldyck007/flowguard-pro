# FlowGuard Pro

A production-grade IoT monitoring and control system for aquarium and aquaculture environments. Built with an ESP32 sensor node, a PHP/MySQL backend, and a modern dark-themed dashboard — delivering real-time telemetry, automated alerts, and intelligent life support management.

![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php)
![ESP32](https://img.shields.io/badge/ESP32-Arduino%20IDE-E7352C?logo=espressif)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green)

## 🌊 Overview

FlowGuard Pro is a comprehensive water quality monitoring platform designed for marine ecosystems, freshwater aquariums, and small-scale aquaculture operations. It combines edge computing on ESP32 with a responsive web dashboard to track critical parameters, detect anomalies, and automate emergency responses — all without expensive commercial monitoring hardware.

The system architecture follows a three-tier design: **Sensor Layer** (ESP32 + analog/digital sensors) → **Data Layer** (PHP REST API + MySQL) → **Presentation Layer** (dark-themed dashboard with real-time charts and controls).

## ✨ Key Features

### 🔬 Multi-Parameter Telemetry
| Parameter | Sensor | Range | Status |
|-----------|--------|-------|--------|
| **Water Temperature** | DS18B20 Waterproof | -55°C to +125°C | ✅ Active |
| **Ammonia (NH₃/NH₄⁺)** | MQ135 Proxy | 0–4.095 ppm (linear) | ⚠️ Calibrate |
| **Turbidity** | SEN0189 Analog | 0–1000 NTU | ✅ Active |
| **Dissolved Oxygen** | Fixed Proxy | 8.0 mg/L (placeholder) | 🔧 Planned |
| **Power / UPS** | ACS712 Current | 0–5A RMS | ✅ Active |
| **Wi-Fi Signal** | ESP32 Built-in | RSSI dBm | ✅ Active |

### 🖥️ Dashboard Modules
- **Dashboard** — Live telemetry cards, battery widget, health score ring, 24h trend charts
- **Analytics** — Deep insights with AI-generated risk events, maintenance tasks, power efficiency tracking, and historical trajectory graphs
- **Control Panel** — Master pump toggle, temperature threshold sliders, ammonia alert sensitivity, auto-response system toggles
- **Alerts & Notifications** — Critical/Warning/Info alert cards, notification preferences (In-app/SMS/Push), 7-day alert distribution chart
- **Device Status** — Hardware health overview, firmware update checker, Wi-Fi signal strength, diagnostics runner

### ⚡ Smart Automation
- **UPS Relay Logic** — ACS712 current monitoring detects mains failure; automatic relay switchover to battery backup
- **Auto-Response System** — Configurable emergency protocols: auto water change, auxiliary O₂ injection, dosage pump suppression
- **Threshold Alerts** — Temperature min/max safe ranges, ammonia sensitivity triggers with cooldown logic
- **Sensor Calibration** — Corner-based background estimation for segmentation-style localized analysis

### 🎨 UI/UX Design
- Dark-first aesthetic with glassmorphism cards and neon accent colors
- Material Symbols iconography throughout
- Responsive bento-grid layouts
- Mobile-optimized bottom navigation bar
- Real-time status indicators with pulsing animations

## 🏗️ Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    PRESENTATION LAYER                        │
│  ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐       │
│  │ Dashboard│ │ Analytics│ │  Alerts  │ │ Control  │       │
│  │  index   │ │  analytics│ │  alerts  │ │  panel   │       │
│  └──────────┘ └──────────┘ └──────────┘ └──────────┘       │
│  ┌──────────┐ ┌──────────┐                                    │
│  │  Status  │ │ Navigation │ ← Shared components            │
│  │  status  │ │  header    │                                    │
│  └──────────┘ └──────────┘                                    │
├─────────────────────────────────────────────────────────────┤
│                      DATA LAYER (PHP/MySQL)                  │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐       │
│  │ post-data.php│  │  db_connect  │  │  API Auth    │       │
│  │ (ESP32 POST) │  │  (MySQLi)    │  │  (api_key)   │       │
│  └──────────────┘  └──────────────┘  └──────────────┘       │
│  tank_telemetry │  device_status  │  alert_history          │
├─────────────────────────────────────────────────────────────┤
│                     EDGE LAYER (ESP32)                         │
│  ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐       │
│  │ DS18B20  │ │  MQ135   │ │SEN0189   │ │  ACS712  │       │
│  │  Temp    │ │  NH₃     │ │ Turbidity│ │  Current │       │
│  └──────────┘ └──────────┘ └──────────┘ └──────────┘       │
│  ┌──────────┐ ┌──────────┐                                    │
│  │  Relay   │ │  Wi-Fi   │ ← Actuators & Connectivity       │
│  │  (UPS)   │ │  HTTP    │                                    │
│  └──────────┘ └──────────┘                                    │
└─────────────────────────────────────────────────────────────┘
```

## 🚀 Getting Started

### Prerequisites
- PHP 8.0+ with MySQLi extension
- MySQL 5.7+ or MariaDB 10.3+
- Arduino IDE with ESP32 board support
- Local web server (Apache/Nginx) or XAMPP/WAMP

### Hardware Requirements
| Component | Model | Purpose |
|-----------|-------|---------|
| Microcontroller | ESP32-DevKitC | Main processing unit |
| Temperature Sensor | DS18B20 Waterproof | Water temperature |
| Gas Sensor | MQ135 | Ammonia proxy detection |
| Turbidity Sensor | SEN0189 / Analog | Water clarity |
| Current Sensor | ACS712-05B | Power/UPS monitoring |
| Relay Module | 5V Single Channel | Battery backup switch |
| Power Supply | 5V/2A USB + LiPo | Main + backup power |

### Installation

#### 1. Database Setup
```bash
# Import the schema
mysql -u root -p flowguard < database/schema.sql

# Add the turbidity column (if upgrading)
mysql -u root -p flowguard < database/add_turbidity_column.sql
```

#### 2. API Configuration
```php
// api/post-data.php — configure your API key
$apiKey = "t74B6554as89";  // Change this!

// includes/db_connect.php — set database credentials
$host = "localhost";
$user = "flowguard_user";
$pass = "your_secure_password";
$db   = "flowguard";
```

#### 3. ESP32 Firmware
1. Open `flowguard.ino` in Arduino IDE
2. Install libraries: `OneWire`, `DallasTemperature`, `WiFi`, `HTTPClient`
3. Update Wi-Fi credentials and server IP:
```cpp
const char* ssid       = "YOUR_SSID";
const char* password   = "YOUR_PASSWORD";
const char* serverName = "http://YOUR_SERVER_IP/flowguard/api/post-data.php";
```
4. Upload to ESP32

#### 4. Web Dashboard
```bash
# Clone to your web root
git clone https://github.com/yourusername/flowguard-pro.git /var/www/html/flowguard

# Or copy to htdocs for XAMPP
cp -r flowguard-pro/* C:/xampp/htdocs/flowguard/
```

### Default File Structure
```
flowguard/
├── index.php              # Main dashboard
├── analytics.php          # Deep insights & charts
├── alerts.php             # Alert history & settings
├── controlpanel.php       # System controls & thresholds
├── status.php             # Hardware health overview
├── api/
│   └── post-data.php      # ESP32 data ingestion endpoint
├── includes/
│   ├── db_connect.php     # Database connection
│   ├── navigation.php     # Sidebar component
│   └── header.php         # Top bar component
├── assets/
│   ├── css/               # Page-specific stylesheets
│   └── js/                # Page-specific scripts
├── database/
│   ├── schema.sql         # Full database schema
│   └── add_turbidity_column.sql  # Migration script
└── flowguard.ino          # ESP32 firmware
```

## 📡 Data Flow

### ESP32 → Server (Every 2 seconds)
```
POST /api/post-data.php
Content-Type: application/x-www-form-urlencoded

api_key=t74B6554as89
&temp=26.40
&ammonia=0.042
&oxygen=8.0
&turbidity=2.15
&pump=ON
&power=MAIN
&battery=100
&wifi=-42
&ip=192.168.100.24
```

### Server Response
```json
{
  "status": "success",
  "rows_affected": 1,
  "timestamp": "2026-06-02 14:38:00"
}
```

## 🛡️ Alert System

| Severity | Trigger | Auto-Action | Notification |
|----------|---------|-------------|--------------|
| **CRITICAL** | Power outage, temp > 30°C | UPS relay ON, pump emergency mode | SMS + Push + In-app |
| **WARNING** | Ammonia > 0.25 ppm, turbidity > 50 NTU | Auto water change initiated | Push + In-app |
| **INFO** | Filter replacement due, calibration needed | Log only | In-app |

## 🔧 Calibration Notes

### MQ135 Ammonia Sensor
The current implementation uses a linear proxy (`raw / 1000`). For accurate ppm readings:
1. Burn-in the sensor for 24 hours
2. Measure Rs in clean air (R0)
3. Apply the MQ135 ammonia curve: `ppm = a * (Rs/R0)^b`
4. Update the formula in `flowguard.ino`

### Turbidity (SEN0189)
The empirical formula used is: `NTU = -1120.4×V² + 5742.3×V - 4352.9`
Calibrate against known NTU standards (0, 20, 100, 800 NTU) and adjust coefficients.

### ACS712 Current Zero-Point
The RMS current algorithm auto-calibrates the zero-point at startup. Ensure no load is connected during the first 500 samples.

## 🗺️ Roadmap

- [ ] **Real DO Sensor** — Replace oxygen proxy with Atlas Scientific EZO-DO
- [ ] **pH Sensor Integration** — Add pH-4502C module
- [ ] **TDS/EC Sensor** — Total dissolved solids monitoring
- [ ] **LoRa Backup** — Off-grid communication for remote ponds
- [ ] **Mobile App** — React Native companion app
- [ ] **MQTT Broker** — Replace HTTP polling with publish/subscribe
- [ ] **AI Predictions** — TensorFlow Lite anomaly detection on ESP32
- [ ] **Multi-Tank Support** — Scale to multiple sensor nodes
- [ ] **Solar + UPS** — Full off-grid power solution
- [ ] **Camera Module** — ESP32-CAM for visual fish health monitoring

## 🤝 Contributing

Contributions are welcome! Priority areas:
- Sensor calibration algorithms and lookup tables
- Additional chart types (Plotly, Chart.js migration)
- Docker containerization for easy deployment
- REST API documentation (OpenAPI/Swagger)
- Unit tests for PHP endpoints

## 📄 License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **DS18B20 Library** — Miles Burton's DallasTemperature library
- **MQ135 Research** — Georgi K. Gashev's calibration methodology
- **UI Design** — Inspired by modern aquaculture dashboards and glassmorphism trends
- **Academic References** — Zuhaer et al. (2025) on sustainable aquaculture IoT systems citeweb_search:2#1

---

<p align="center">
  Built for marine ecosystems 🐠 — Engineered for reliability ⚡
</p>
