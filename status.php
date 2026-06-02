<?php
/**
 * FlowGuard Pro – Device Status
 * Hardware health overview – live data pulled from device_status table
 */
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FlowGuard Pro – Device Status</title>
    <link rel="stylesheet" href="assets/css/status.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body>

<?php include 'includes/navigation.php'; ?>

<div class="main-container">

    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Page Header -->
        <div class="status-header">
            <div class="header-title">
                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">router</span>
                <h2>Hardware health overview</h2>
            </div>
            <p class="header-description">Real-time diagnostics and operational integrity monitoring for all connected FlowGuard hardware modules.</p>
        </div>

        <!-- Status Bento Grid -->
        <div class="status-grid">

            <!-- Sensor Suite Card -->
            <div class="status-card" data-card="sensor">
                <div class="card-header">
                    <div class="card-icon primary">
                        <span class="material-symbols-outlined">sensors</span>
                    </div>
                    <div class="status-badge primary" id="sensor-badge">OPERATIONAL</div>
                </div>
                <div class="card-body">
                    <h3 class="card-label">Sensor Suite</h3>
                    <div class="card-value primary" id="sensor-value">Active</div>
                </div>
                <div class="card-footer">
                    <div class="footer-item">
                        <span class="footer-label">Last Calibration</span>
                        <span class="footer-value" id="sensor-footer">–</span>
                    </div>
                </div>
            </div>

            <!-- Pump Condition Card (static – no DB mapping yet) -->
            <div class="status-card" data-card="pump">
                <div class="card-header">
                    <div class="card-icon secondary">
                        <span class="material-symbols-outlined">cyclone</span>
                    </div>
                    <div class="status-badge secondary">OPTIMAL</div>
                </div>
                <div class="card-body">
                    <h3 class="card-label">Pump Condition</h3>
                    <div class="card-value secondary">Good</div>
                </div>
                <div class="card-footer">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:88%"></div>
                    </div>
                    <div class="progress-label">
                        <span class="footer-label">Efficiency</span>
                        <span class="footer-value secondary">88%</span>
                    </div>
                </div>
            </div>

            <!-- UPS Battery Card -->
            <div class="status-card" data-card="ups">
                <div class="card-header">
                    <div class="card-icon tertiary">
                        <span class="material-symbols-outlined" id="ups-icon">battery_very_low</span>
                    </div>
                    <div class="status-badge tertiary" id="ups-badge">HEALTHY</div>
                </div>
                <div class="card-body">
                    <h3 class="card-label">UPS Battery Health</h3>
                    <div class="card-value tertiary" id="ups-value">Healthy</div>
                </div>
                <div class="card-footer">
                    <div class="footer-item">
                        <span class="footer-label">Power Source</span>
                        <span class="footer-value" id="ups-footer">–</span>
                    </div>
                </div>
            </div>

            <!-- Wi-Fi Connectivity Card -->
            <div class="status-card" data-card="wifi">
                <div class="card-header">
                    <div class="card-icon primary">
                        <span class="material-symbols-outlined">wifi</span>
                    </div>
                    <div class="status-badge primary" id="wifi-badge">– dBm</div>
                </div>
                <div class="card-body">
                    <h3 class="card-label">Wi-Fi Connectivity</h3>
                    <div class="card-value primary" id="wifi-value">–</div>
                </div>
                <div class="card-footer">
                    <div class="wifi-signal">
                        <div class="signal-bar"></div>
                        <div class="signal-bar"></div>
                        <div class="signal-bar"></div>
                        <div class="signal-bar"></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Detailed Analysis Section -->
        <div class="analysis-grid">
            <!-- Firmware Update -->
            <div class="firmware-card">
                <div class="firmware-icon">
                    <span class="material-symbols-outlined">system_update</span>
                </div>
                <div class="firmware-content">
                    <div class="firmware-header">
                        <div class="status-indicator"></div>
                        <h3>Firmware Update</h3>
                    </div>
                    <div class="firmware-body">
                        <div class="version-info">
                            <div class="version-label">CURRENT VERSION</div>
                            <div class="version-number">Version 2.1.0</div>
                            <span class="version-status">(Latest)</span>
                        </div>
                        <div class="update-notes">
                            <div class="note-item">
                                <span class="material-symbols-outlined">check_circle</span>
                                <p>Enhanced CO2 regulator precision for planted tanks.</p>
                            </div>
                            <div class="note-item">
                                <span class="material-symbols-outlined">check_circle</span>
                                <p>Reduced latency in cloud telemetry synchronization.</p>
                            </div>
                        </div>
                        <button class="btn-primary" id="update-btn">Check for Updates</button>
                    </div>
                    <div class="firmware-footer">
                        <span>Last checked: Today at 04:12 AM</span>
                        <span>Auto-update: <span class="enabled">Enabled</span></span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions / Support -->
            <div class="quick-actions">
                <button class="action-button" id="restart-btn">
                    <div class="action-icon">
                        <span class="material-symbols-outlined">restart_alt</span>
                    </div>
                    <div class="action-text">
                        <span class="action-title">Restart Controller</span>
                        <span class="action-subtitle">Perform a soft reset</span>
                    </div>
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>

                <button class="action-button" id="diagnostics-btn">
                    <div class="action-icon">
                        <span class="material-symbols-outlined">content_paste_search</span>
                    </div>
                    <div class="action-text">
                        <span class="action-title">Run Diagnostics</span>
                        <span class="action-subtitle">Complete hardware test</span>
                    </div>
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>

                <div class="support-card">
                    <div class="support-header">
                        <span class="material-symbols-outlined">help_center</span>
                        <span class="support-title">Support Status</span>
                    </div>
                    <p class="support-text">Your FlowGuard Pro is under Premium Protection. 24/7 priority support is active for this device.</p>
                    <a href="#" class="support-link" id="support-contact">Contact Technician →</a>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="assets/js/status.js"></script>
</body>
</html>
