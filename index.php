<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FlowGuard Pro - Dashboard</title>
    <link rel="stylesheet" href="assets/css/index.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body>

<!-- Navigation Component -->
<aside>
    <div class="nav-brand">
        <div class="nav-brand-icon">
            <span class="material-symbols-outlined">water</span>
        </div>
        <div>
            <h1>FLOWGUARD</h1>
            <p>ONLINE</p>
        </div>
    </div>
    <nav>
        <a href="#dashboard">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
        </a>
        <a href="#analytics">
            <span class="material-symbols-outlined">analytics</span>
            <span>Analytics</span>
        </a>
        <a href="#devices">
            <span class="material-symbols-outlined">devices</span>
            <span>Devices</span>
        </a>
        <a href="#settings">
            <span class="material-symbols-outlined">settings</span>
            <span>Settings</span>
        </a>
    </nav>
</aside>

<!-- Main Content Area -->
<div class="main-container">
    
    <!-- Header Component -->
    <header>
        <div class="header-left">
            <div class="header-logo">FLOWGUARD</div>
            <div class="header-divider"></div>
            <div class="header-status">
                <div class="status-dot"></div>
                <div class="status-text">Online</div>
            </div>
        </div>
        <div class="header-right">
            <div class="tank-selector">
                <span class="material-symbols-outlined" style="font-size:18px;">location_on</span>
                <span>Tank 1</span>
            </div>
            <div class="header-buttons">
                <button class="header-btn notification-btn">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <button class="header-btn theme-btn">
                    <span class="material-symbols-outlined">light_mode</span>
                </button>
            </div>
        </div>
    </header>
    
    <!-- Dashboard Canvas -->
    <main>
        <!-- Hero Metrics Grid -->
        <div class="metrics-grid">
            
            <!-- AI Health Score (Large Card) -->
            <div class="metric-card metric-card-large">
                <div class="metric-icon-large">
                    <span class="material-symbols-outlined">auto_awesome</span>
                </div>
                <div class="metric-content">
                    <div class="metric-circle">
                        <svg viewBox="0 0 128 128">
                            <circle cx="64" cy="64" r="58" fill="transparent" stroke="rgba(255, 255, 255, 0.05)" stroke-width="8"></circle>
                            <circle cx="64" cy="64" r="58" fill="transparent" stroke="#00e5ff" stroke-dasharray="364.4" stroke-dashoffset="7.28" stroke-width="8" style="drop-shadow: 0 0 8px rgba(0,229,255,0.6);"></circle>
                        </svg>
                        <div class="metric-value">
                            <span class="metric-number">—</span>
                            <span class="metric-subtitle">/ 100</span>
                        </div>
                    </div>
                </div>
                <div class="metric-text">
                    <div class="metric-title">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 20px; color: #00e5ff;">verified</span>
                        <span>Tank Health Score</span>
                    </div>
                    <p class="metric-description">AI analysis confirms optimal biological balance. All life support systems are within peak parameters.</p>
                    <div class="metric-tags">
                        <span class="metric-tag metric-tag-primary">Stable Environment</span>
                        <span class="metric-tag">Updated Now</span>
                    </div>
                </div>
            </div>
            
            <!-- Battery Widget -->
            <div class="metric-card">
                <div class="battery-header">
                    <div>
                        <div class="battery-label">Battery Backup</div>
                        <div class="battery-percent">—%</div>
                    </div>
                    <div class="battery-icon">
                        <span class="material-symbols-outlined">battery_very_low</span>
                    </div>
                </div>
                <div class="battery-runtime">
                    <div class="battery-label-row">
                        <span class="battery-label">Estimated runtime</span>
                        <span style="color: var(--color-secondary); font-weight: bold; font-size: 12px;">4h 15m remaining</span>
                    </div>
                    <div class="battery-bar">
                        <div class="battery-fill"></div>
                    </div>
                </div>
            </div>
            
            <!-- Last Updated -->
            <div class="metric-card updated-container">
                <div class="updated-content">
                    <span class="updated-icon">schedule</span>
                    <div class="battery-label">Last Updated</div>
                    <span style="font-family: 'Manrope', sans-serif; font-size: 18px; color: var(--color-primary);">—</span>
                    <p style="font-size: 12px; color: rgba(186, 201, 204, 0.6); margin-top: 8px;">Next sync in 42s</p>
                </div>
            </div>
        </div>
        
        <!-- Main Metrics & Chart Section -->
        <div class="chart-container">
            
            <!-- Telemetry Metrics -->
            <div class="telemetry-section">
                <div class="telemetry-grid">
                    
                    <!-- Water Temp -->
                    <div class="telemetry-item metric-card-small">
                        <span class="material-symbols-outlined telemetry-icon" style="color: var(--color-primary-fixed-dim);">thermostat</span>
                        <div>
                            <p class="telemetry-label">Water Temp</p>
                            <p class="telemetry-value">—</p>
                        </div>
                        <div class="telemetry-status">
                            <span class="material-symbols-outlined" style="font-size: 18px;">trending_flat</span>
                            <span>Optimal</span>
                        </div>
                    </div>
                    
                    <!-- Ammonia -->
                    <div class="telemetry-item metric-card-small">
                        <span class="material-symbols-outlined telemetry-icon" style="color: var(--color-tertiary);">science</span>
                        <div>
                            <p class="telemetry-label">Ammonia</p>
                            <p class="telemetry-value">—<span class="telemetry-unit">ppm</span></p>
                        </div>
                        <div class="telemetry-status">
                            <span class="material-symbols-outlined" style="font-size: 18px;">check_circle</span>
                            <span>Safe Range</span>
                        </div>
                    </div>
                    
                    <!-- Dissolved Oxygen -->
                    <div class="telemetry-item metric-card-small">
                        <span class="material-symbols-outlined telemetry-icon" style="color: var(--color-primary);">air</span>
                        <div>
                            <p class="telemetry-label">Oxygen</p>
                            <p class="telemetry-value">—<span class="telemetry-unit">mg/L</span></p>
                        </div>
                        <div class="telemetry-status">
                            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_upward</span>
                            <span>High Flow</span>
                        </div>
                    </div>
                    
                    <!-- Water Quality -->
                    <div class="telemetry-item metric-card-small">
                        <span class="material-symbols-outlined telemetry-icon glow-pulse-green" style="color: var(--color-primary);">opacity</span>
                        <div>
                            <p class="telemetry-label">Quality</p>
                            <p class="telemetry-value">Clean</p>
                        </div>
                        <div class="telemetry-status">
                            <span class="material-symbols-outlined" style="font-size: 18px;">verified</span>
                            <span>Pristine</span>
                        </div>
                    </div>
                    
                    <!-- Pump Status -->
                    <div class="telemetry-item metric-card-small">
                        <span class="material-symbols-outlined telemetry-icon" style="color: var(--color-primary);">cyclone</span>
                        <div>
                            <p class="telemetry-label">Pump</p>
                            <p class="telemetry-value">—</p>
                        </div>
                        <div class="telemetry-status">
                            <span class="material-symbols-outlined" style="font-size: 18px;">sync</span>
                            <span>Flowing</span>
                        </div>
                    </div>
                    
                    <!-- Power Status -->
                    <div class="telemetry-item metric-card-small">
                        <span class="material-symbols-outlined telemetry-icon" style="color: var(--color-primary);">bolt</span>
                        <div>
                            <p class="telemetry-label">Power</p>
                            <p class="telemetry-value" style="text-transform: uppercase;">—</p>
                        </div>
                        <div class="telemetry-status">
                            <span class="material-symbols-outlined" style="font-size: 18px;">electric_bolt</span>
                            <span>—</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Central Chart Area -->
            <div class="chart-section">
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <h3 class="chart-title">Temperature &amp; Ammonia</h3>
                            <p class="chart-subtitle">24-hour historical telemetry tracking</p>
                        </div>
                        <div class="chart-buttons">
                            <button class="chart-btn active" data-period="24h">24H</button>
                            <button class="chart-btn" data-period="7d">7D</button>
                            <button class="chart-btn" data-period="30d">30D</button>
                        </div>
                    </div>
                    
                    <div class="chart-content">
                        <!-- Chart Grid -->
                        <div class="chart-grid">
                            <div class="chart-grid-line"></div>
                            <div class="chart-grid-line"></div>
                            <div class="chart-grid-line"></div>
                            <div class="chart-grid-line"></div>
                        </div>
                        
                        <!-- Area Fill Simulation -->
                        <div class="chart-area"></div>
                        
                        <!-- SVG Curve -->
                        <svg class="chart-svg" viewBox="0 0 1000 200">
                            <path d="M0,100 C150,80 250,120 400,90 C550,60 750,110 1000,70" fill="none" stroke="#00daf3" stroke-linecap="round" stroke-width="4"></path>
                            <path d="M0,150 C200,160 400,140 600,155 C800,170 1000,145" fill="none" stroke="#94ccff" stroke-dasharray="8 4" stroke-linecap="round" stroke-width="2"></path>
                        </svg>
                        
                        <!-- Tooltip Example -->
                        <div class="chart-tooltip">
                            <div class="tooltip-content">
                                <div class="tooltip-row">
                                    <div class="tooltip-item">
                                        <span class="tooltip-label">Temp</span>
                                        <span class="tooltip-value">—°C</span>
                                    </div>
                                    <div class="tooltip-divider"></div>
                                    <div class="tooltip-item">
                                        <span class="tooltip-label">Ammonia</span>
                                        <span class="tooltip-value">— ppm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tooltip-dot"></div>
                            <div class="tooltip-line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional Metrics Grid -->
        <div class="metrics-grid">
            <!-- Filter Status -->
            <div class="metric-card metric-card-small">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <span class="material-symbols-outlined" style="color: var(--color-secondary);">filter_list</span>
                    <div>
                        <p class="battery-label">Filter Status</p>
                        <p class="telemetry-value" style="font-size: 18px; margin-top: 4px;">Good</p>
                    </div>
                </div>
                <p class="telemetry-status">
                    <span class="material-symbols-outlined" style="font-size: 18px;">schedule</span>
                    <span>Next replacement: 28 days</span>
                </p>
            </div>
            
            <!-- Light Intensity -->
            <div class="metric-card metric-card-small">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <span class="material-symbols-outlined" style="color: var(--color-primary-fixed-dim);">light_mode</span>
                    <div>
                        <p class="battery-label">Light Intensity</p>
                        <p class="telemetry-value" style="font-size: 18px; margin-top: 4px;">850 lux</p>
                    </div>
                </div>
                <p class="telemetry-status">
                    <span class="material-symbols-outlined" style="font-size: 18px;">trending_up</span>
                    <span>Peak conditions</span>
                </p>
            </div>
            
            <!-- Automation Status -->
            <div class="metric-card metric-card-small">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <span class="material-symbols-outlined" style="color: var(--color-primary);">settings_remote</span>
                    <div>
                        <p class="battery-label">Automation</p>
                        <p class="telemetry-value" style="font-size: 18px; margin-top: 4px;">Active</p>
                    </div>
                </div>
                <p class="telemetry-status">
                    <span class="material-symbols-outlined" style="font-size: 18px;">check_circle</span>
                    <span>All systems automated</span>
                </p>
            </div>
            
            <!-- System Uptime -->
            <div class="metric-card metric-card-small">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <span class="material-symbols-outlined" style="color: var(--color-tertiary);">uptime</span>
                    <div>
                        <p class="battery-label">System Uptime</p>
                        <p class="telemetry-value" style="font-size: 18px; margin-top: 4px;">99.9%</p>
                    </div>
                </div>
                <p class="telemetry-status">
                    <span class="material-symbols-outlined" style="font-size: 18px;">verified</span>
                    <span>Excellent reliability</span>
                </p>
            </div>
        </div>
    </main>
</div>

<!-- Load JavaScript -->
<script src="assets/js/index.js"></script>

</body>
</html>
