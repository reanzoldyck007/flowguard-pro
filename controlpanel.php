<?php
/**
 * FlowGuard Pro - Control Panel
 * Manage critical life support systems and telemetry thresholds
 */
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FlowGuard Pro - Control Panel</title>
    <link rel="stylesheet" href="assets/css/controlpanel.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body>

<!-- Navigation Component -->
<?php include 'includes/navigation.php'; ?>

<!-- Main Content Area -->
<div class="main-container">
    
    <!-- Header Component -->
    <?php include 'includes/header.php'; ?>
    
    <!-- Control Panel Canvas -->
    <main>
        <div class="page-header">
            <h1>Control Panel</h1>
            <p>Manage critical life support systems and telemetry thresholds.</p>
        </div>
        <!-- Bento Grid Layout -->
        <div class="control-grid">
            
            <!-- Master Pump Toggle Section -->
            <div class="control-card pump-card">
                <div class="card-bg-glow"></div>
                <div class="card-content">
                    <div class="card-icon">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 32px;">vital_signs</span>
                    </div>
                    <h3 class="card-title">Master Pump</h3>
                    <p class="card-description">Main circulation system for tank water turnover and filtration.</p>
                </div>
                <div class="card-footer">
                    <div class="state-display">
                        <span class="state-label">CURRENT STATE</span>
                        <span class="state-value">ACTIVE</span>
                    </div>
                    <button class="pump-toggle-btn">
                        <span class="material-symbols-outlined">power_settings_new</span>
                        TOGGLE PUMP
                    </button>
                </div>
            </div>

            <!-- Temperature Thresholds Section -->
            <div class="control-card temp-card">
                <div class="card-header">
                    <div class="header-left">
                        <div class="card-icon">
                            <span class="material-symbols-outlined">thermostat</span>
                        </div>
                        <div>
                            <h3 class="card-title">Temperature Thresholds</h3>
                            <p class="card-description">Critical operating range for biological stability.</p>
                        </div>
                    </div>
                    <div class="temp-display">
                        <span class="temp-value">26.4°C</span>
                    </div>
                </div>
                <div class="temp-grid">
                    <!-- Min Temp -->
                    <div class="temp-control">
                        <div class="temp-header">
                            <label>MINIMUM SAFE (LOW)</label>
                            <span class="temp-reading">24.0°C</span>
                        </div>
                        <input type="range" class="temp-slider" min="20" max="30" value="24" data-type="min"/>
                        <div class="temp-scale">
                            <span>20°C</span>
                            <span>30°C</span>
                        </div>
                    </div>
                    <!-- Max Temp -->
                    <div class="temp-control">
                        <div class="temp-header">
                            <label>MAXIMUM SAFE (HIGH)</label>
                            <span class="temp-reading">28.0°C</span>
                        </div>
                        <input type="range" class="temp-slider" min="20" max="30" value="28" data-type="max"/>
                        <div class="temp-scale">
                            <span>20°C</span>
                            <span>30°C</span>
                        </div>
                    </div>
                </div>
                <div class="temp-info">
                    <span class="material-symbols-outlined">info</span>
                    <p>System will trigger "Cooling Phase" if temperature exceeds 28°C for more than 5 minutes.</p>
                </div>
            </div>

            <!-- Ammonia Alert Section -->
            <div class="control-card ammonia-card">
                <div class="card-header">
                    <div class="card-icon">
                        <span class="material-symbols-outlined">warning</span>
                    </div>
                    <div>
                        <h3 class="card-title">Ammonia Alert Trigger</h3>
                        <p class="card-description">Sensitivity for NH3/NH4+ toxicity detection.</p>
                    </div>
                </div>
                <div class="ammonia-content">
                    <div class="sensitivity-box">
                        <label>SENSITIVITY LEVEL</label>
                        <div class="sensitivity-control">
                            <div class="sensitivity-value">
                                <span class="value-number">0.5</span>
                                <span class="value-unit">ppm</span>
                            </div>
                            <div class="sensitivity-buttons">
                                <button class="ammonia-btn minus-btn">
                                    <span class="material-symbols-outlined">remove</span>
                                </button>
                                <button class="ammonia-btn plus-btn">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="sensitivity-indicator">
                        <div class="indicator-bar filled"></div>
                        <div class="indicator-bar filled"></div>
                        <div class="indicator-bar"></div>
                        <div class="indicator-bar"></div>
                        <div class="indicator-bar"></div>
                    </div>
                </div>
            </div>

            <!-- Auto-Response System Section -->
            <div class="control-card autoresponse-card">
                <div class="card-header auto-header">
                    <div class="header-left">
                        <div class="card-icon">
                            <span class="material-symbols-outlined">auto_awesome</span>
                        </div>
                        <div>
                            <h3 class="card-title">Auto-Response System</h3>
                            <p class="card-description">Automated emergency mitigation protocols.</p>
                        </div>
                    </div>
                    <!-- Toggle Switch -->
                    <div class="toggle-switch">
                        <div class="toggle-track">
                            <div class="toggle-thumb"></div>
                        </div>
                    </div>
                </div>
                <div class="response-list">
                    <div class="response-item enabled">
                        <div class="response-icon">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <span class="response-text">Auto-Water Change (Level Critical)</span>
                        <span class="response-status">Enabled</span>
                    </div>
                    <div class="response-item enabled">
                        <div class="response-icon">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <span class="response-text">Auxiliary O2 Injection</span>
                        <span class="response-status">Enabled</span>
                    </div>
                    <div class="response-item disabled">
                        <div class="response-icon">
                            <span class="material-symbols-outlined">radio_button_unchecked</span>
                        </div>
                        <span class="response-text">Dosage Pump Suppression</span>
                        <span class="response-status">Disabled</span>
                    </div>
                </div>
            </div>

            <!-- Visual Asset Section -->
            <div class="control-card visual-card">
                <img alt="AQUARIUM TECH" class="visual-image" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCeF5u_1CoHN63_z9NWgaDxSJeeEIM5VjPNvP_5nbsoZ14jOSRD-Y6-uy8PZsrlyKdxq1KVoax4uTTXsXYRfB_zLCnLfgpMRbsK2KP12dKP4wlNucrMPh8d6jp730U2ptFUoxhu8ugMF5zcdrln-w8qe_GvVnTqizaOJ3NRl3wmxBKvxeG1uvF2qDUQKP0YKCzFh0UfAox1NQifQxcN1CwGg-mQeKKeTklCtbvE3fr06HUjtYuAnMzmG_quVjOf4dS7enW3CvEKaV4"/>
                <div class="visual-overlay"></div>
                <div class="visual-text">
                    <h4>REAL-TIME TELEMETRY STREAM</h4>
                    <p>Visual confirmation of biological stability.</p>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Load JavaScript -->
<script src="assets/js/controlpanel.js"></script>
</body>
</html>
