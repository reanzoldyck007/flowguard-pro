<?php
/**
 * FlowGuard Pro Analytics
 * Analytics page - includes header and navigation
 */
include 'includes/db_connect.php';
$sql = "SELECT * FROM tank_telemetry WHERE id = 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FlowGuard Pro - Analytics</title>
    <link rel="stylesheet" href="assets/css/analytics.css"/>
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
    
    <!-- Analytics Canvas -->
    <main>
        <!-- Page Header -->
        <section class="page-header">
            <div>
                <h1 class="page-title">FlowGuard Analytics</h1>
                <p class="page-subtitle">Deep telemetry insights for your marine ecosystem. Real-time chemical analysis and power efficiency tracking.</p>
            </div>
            <div class="button-group">
                <button class="btn btn-primary">
                    <span class="material-symbols-outlined">picture_as_pdf</span>
                    Generate PDF Report
                </button>
                <button class="btn btn-secondary">
                    <span class="material-symbols-outlined">history</span>
                    History
                </button>
            </div>
        </section>

        <!-- AI Insights Bento Grid -->
        <section class="insights-grid">
            <!-- Insight 1: Risk Events -->
            <div class="insight-card">
                <div class="insight-header">
                    <div class="insight-icon risk-icon">
                        <span class="material-symbols-outlined">warning</span>
                    </div>
                    <h3 class="insight-title">Weekly Risk Events</h3>
                </div>
                <p class="insight-value">3 <span class="insight-count">Identified</span></p>
                <p class="insight-description">Your tank had 3 risk events this week involving pH volatility. Monitor sensor 02.</p>
            </div>

            <!-- Insight 2: Maintenance Task -->
            <div class="insight-card">
                <div class="insight-header">
                    <div class="insight-icon maintenance-icon">
                        <span class="material-symbols-outlined">water_drop</span>
                    </div>
                    <h3 class="insight-title">Maintenance Task</h3>
                </div>
                <div class="insight-badge">
                    <span class="badge-urgent">Urgent</span>
                    <p class="badge-text">Perform water change soon</p>
                </div>
                <p class="insight-description">Nitrate levels are approaching threshold of 25ppm. Schedule 15% change within 24h.</p>
            </div>

            <!-- Insight 3: Power Efficiency -->
            <div class="insight-card">
                <div class="insight-header">
                    <div class="insight-icon power-icon">
                        <span class="material-symbols-outlined">bolt</span>
                    </div>
                    <h3 class="insight-title">Power Efficiency</h3>
                </div>
                <p class="insight-value">94% <span class="insight-count">Optimization</span></p>
                <p class="insight-description">Chiller duty cycle is optimal. Your current power usage vs backup duration is stable.</p>
            </div>
        </section>

        <!-- Large Graphs Section -->
        <section class="graphs-grid">
            <!-- Temperature Trends -->
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Temperature Trends</h3>
                        <p class="chart-subtitle">Last 24 Hours • 78.4°F Avg</p>
                    </div>
                    <button class="fullscreen-btn">
                        <span class="material-symbols-outlined">fullscreen</span>
                    </button>
                </div>
                <div class="chart-content temperature-chart">
                    <div class="chart-grid"></div>
                    <svg class="chart-svg" preserveAspectRatio="none" viewBox="0 0 1000 200">
                        <path class="chart-area" d="M0,150 Q100,140 200,160 T400,145 T600,155 T800,140 T1000,150 L1000,200 L0,200 Z"></path>
                        <path class="chart-line" d="M0,150 Q100,140 200,160 T400,145 T600,155 T800,140 T1000,150" fill="none" stroke="#00daf3" stroke-linecap="round" stroke-width="3"></path>
                    </svg>
                    <div class="chart-labels">
                        <span>00:00</span><span>06:00</span><span>12:00</span><span>18:00</span><span>23:59</span>
                    </div>
                </div>
            </div>

            <!-- Ammonia Levels -->
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Ammonia Levels</h3>
                        <p class="chart-subtitle">7-Day Trajectory • NH3/NH4+</p>
                    </div>
                    <div class="status-indicator">
                        <span class="status-dot"></span>
                        <span class="status-label">Nominal</span>
                    </div>
                </div>
                <div class="chart-content ammonia-chart">
                    <div class="chart-grid"></div>
                    <svg class="chart-svg" preserveAspectRatio="none" viewBox="0 0 1000 200">
                        <path class="chart-area-ammonia" d="M0,180 Q150,170 300,185 T600,175 T1000,190 L1000,200 L0,200 Z"></path>
                        <path class="chart-line-ammonia" d="M0,180 Q150,170 300,185 T600,175 T1000,190" fill="none" stroke="#94ccff" stroke-dasharray="8 4" stroke-linecap="round" stroke-width="3"></path>
                    </svg>
                    <div class="chart-labels">
                        <span>MON</span><span>WED</span><span>FRI</span><span>SUN</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom Data Section -->
        <section class="bottom-section">
            <!-- Bar Chart: Power vs Backup -->
            <div class="power-chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Power Usage vs Backup Duration</h3>
                        <p class="chart-description">Comparative analysis of daily wattage draw against estimated UPS runtime.</p>
                    </div>
                </div>
                <div class="bar-chart">
                    <div class="bar-item">
                        <div class="bar" style="height: 60%"></div>
                        <span class="bar-label">MON</span>
                    </div>
                    <div class="bar-item">
                        <div class="bar" style="height: 85%"></div>
                        <span class="bar-label">TUE</span>
                    </div>
                    <div class="bar-item">
                        <div class="bar" style="height: 70%"></div>
                        <span class="bar-label">WED</span>
                    </div>
                    <div class="bar-item">
                        <div class="bar" style="height: 95%"></div>
                        <span class="bar-label">THU</span>
                    </div>
                    <div class="bar-item">
                        <div class="bar" style="height: 65%"></div>
                        <span class="bar-label">FRI</span>
                    </div>
                    <div class="bar-item">
                        <div class="bar" style="height: 40%"></div>
                        <span class="bar-label">SAT</span>
                    </div>
                    <div class="bar-item">
                        <div class="bar" style="height: 55%"></div>
                        <span class="bar-label">SUN</span>
                    </div>
                </div>
            </div>

            <!-- System Health Card -->
            <div class="system-health-card">
                <h3 class="chart-title">System Health</h3>
                <div class="health-metrics">
                    <div class="health-item">
                        <div class="health-label">
                            <span>Sensors Online</span>
                            <span class="health-value">12/12</span>
                        </div>
                        <div class="health-bar">
                            <div class="health-fill" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="health-item">
                        <div class="health-label">
                            <span>Storage Capacity</span>
                            <span class="health-value">82%</span>
                        </div>
                        <div class="health-bar">
                            <div class="health-fill secondary" style="width: 82%"></div>
                        </div>
                    </div>
                    <div class="health-item">
                        <div class="health-label">
                            <span>AI Latency</span>
                            <span class="health-value">12ms</span>
                        </div>
                        <div class="health-bar">
                            <div class="health-fill tertiary" style="width: 15%"></div>
                        </div>
                    </div>
                </div>
                <div class="system-image">
                    <img alt="System Visual" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlIiiOeSXMz5cdKJAOzBIgqZp5-_HRwQD80lToR-ICJo_Xz28c7uOvRoOuWG3IbLp1V-hxzXdtLxtglERES5aY_1U9lQQFF1trPqnq9ZtUmt1rSZY04stE66uxgP0V-432rPEHDzJXh_nBDYwFPwq7Jex4y7rhFpRVijbmUqDDjjm97Mcz2SRBf5vCrkCO-QJcGA9xEB2iqsIb09g5hAQI6OGU05W1RVa6xYYivdls9UnGllMavK9yRvrE7LZVymPZQf3snjUWd5A"/>
                    <div class="video-label">
                        <span class="material-symbols-outlined">videocam</span>
                        <span>SUMP_LIVE_FEED</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mobile Navigation (Bottom Bar) -->
        <nav class="mobile-nav">
            <button class="mobile-nav-btn">
                <span class="material-symbols-outlined">dashboard</span>
            </button>
            <button class="mobile-nav-btn">
                <span class="material-symbols-outlined">settings_input_component</span>
            </button>
            <button class="mobile-nav-btn active">
                <span class="material-symbols-outlined">analytics</span>
            </button>
            <button class="mobile-nav-btn">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button class="mobile-nav-btn">
                <span class="material-symbols-outlined">person</span>
            </button>
        </nav>
    </main>
</div>

<!-- Load JavaScript -->
<script src="assets/js/analytics.js"></script>

</body>
</html>
