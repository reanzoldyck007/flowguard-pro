<?php
/**
 * FlowGuard Pro - Alerts & Notifications Page
 * Main alerts page - includes header and navigation
 */

// Include database connection if needed
// include 'includes/db_connect.php';
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FlowGuard Pro - Alerts & Notifications</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/alerts.css"/>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS (for any inline utility classes if needed) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>
<body>

<!-- Navigation Component -->
<?php include 'includes/navigation.php'; ?>

<!-- Main Content Area -->
<div class="main-container">
    
    <!-- Header Component -->
    <?php include 'includes/header.php'; ?>
    
    <!-- Alerts Content -->
    <main>
        <div style="display: flex; flex-direction: column; gap: 32px;">
            
            <!-- Header Section -->
            <section>
                <h2>Alerts &amp; Notifications</h2>
                <p>Real-time monitoring and critical system telemetry alerts. Manage how you receive updates and review historical performance logs.</p>
            </section>
            
            <!-- Notification Settings - Bento Style -->
            <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px;">
                <div class="notification-settings-card glass-card">
                    <div class="notification-settings-content">
                        <div class="notification-settings-icon">
                            <span class="material-symbols-outlined">settings</span>
                        </div>
                        <div class="notification-settings-text">
                            <h3>Notification Settings</h3>
                            <p>Manage global notification preferences</p>
                        </div>
                    </div>
                    <div class="toggle-group">
                        <!-- Toggle: In-app -->
                        <div class="toggle-item">
                            <span class="toggle-label">In-app</span>
                            <button class="toggle-button active">
                                <div class="toggle-dot"></div>
                            </button>
                        </div>
                        
                        <!-- Toggle: SMS -->
                        <div class="toggle-item">
                            <span class="toggle-label">SMS</span>
                            <button class="toggle-button">
                                <div class="toggle-dot"></div>
                            </button>
                        </div>
                        
                        <!-- Toggle: Push -->
                        <div class="toggle-item">
                            <span class="toggle-label">Push</span>
                            <button class="toggle-button active">
                                <div class="toggle-dot"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Alert History -->
            <section>
                <div class="alert-history-header">
                    <h3>Alert History</h3>
                    <span class="sort-badge">Sorted by: Recency</span>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 16px; class='alert-cards-container'">
                    
                    <!-- Critical Alert -->
                    <div class="alert-card glass-card critical">
                        <div class="alert-content">
                            <div class="alert-icon-container status-pulse">
                                <span class="material-symbols-outlined">power_off</span>
                            </div>
                            <div class="alert-text">
                                <div class="alert-header">
                                    <span class="alert-badge critical">CRITICAL</span>
                                    <span class="alert-timestamp">Today, 08:42 AM</span>
                                </div>
                                <h4 class="alert-title">Power Outage Detected</h4>
                                <p class="alert-description">Main power supply disconnected. System running on backup battery. Est. remaining: 4h 12m.</p>
                            </div>
                        </div>
                        <button class="alert-button critical">Resolve</button>
                    </div>
                    
                    <!-- Warning Alert -->
                    <div class="alert-card glass-card warning">
                        <div class="alert-content">
                            <div class="alert-icon-container status-pulse">
                                <span class="material-symbols-outlined">warning</span>
                            </div>
                            <div class="alert-text">
                                <div class="alert-header">
                                    <span class="alert-badge warning">WARNING</span>
                                    <span class="alert-timestamp">Yesterday, 10:15 PM</span>
                                </div>
                                <h4 class="alert-title">High Ammonia Spike</h4>
                                <p class="alert-description">Ammonia levels reached 0.25 ppm. Automatic water change initiated. Current: 0.18 ppm.</p>
                            </div>
                        </div>
                        <button class="alert-button secondary">View Data</button>
                    </div>
                    
                    <!-- Info Alert -->
                    <div class="alert-card glass-card info">
                        <div class="alert-content">
                            <div class="alert-icon-container">
                                <span class="material-symbols-outlined">check_circle</span>
                            </div>
                            <div class="alert-text">
                                <div class="alert-header">
                                    <span class="alert-badge info">INFO</span>
                                    <span class="alert-timestamp">Oct 24, 02:30 PM</span>
                                </div>
                                <h4 class="alert-title">System Online</h4>
                                <p class="alert-description">Firmware v2.4.1 successfully installed. All peripheral sensors recalibrated and active.</p>
                            </div>
                        </div>
                        <button class="alert-button secondary">Details</button>
                    </div>
                    
                </div>
            </section>
            
            <!-- Alert Distribution Chart -->
            <section class="chart-card glass-card">
                <div class="chart-header">
                    <div>
                        <h3>Alert Distribution</h3>
                        <p>7-day performance overview</p>
                    </div>
                    <div class="chart-legend">
                        <span class="chart-legend-item">
                            <div class="chart-legend-dot critical"></div>
                            Critical
                        </span>
                        <span class="chart-legend-item">
                            <div class="chart-legend-dot warning"></div>
                            Warning
                        </span>
                    </div>
                </div>
                
                <div class="chart-container">
                    <!-- Monday -->
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar-stacked">
                            <div class="chart-bar-segment info" style="height: 10%;"></div>
                        </div>
                        <span class="chart-day-label">Mon</span>
                    </div>
                    
                    <!-- Tuesday -->
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar-stacked">
                            <div class="chart-bar-segment info" style="height: 15%;"></div>
                            <div class="chart-bar-segment warning" style="height: 20%;"></div>
                        </div>
                        <span class="chart-day-label">Tue</span>
                    </div>
                    
                    <!-- Wednesday -->
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar-stacked">
                            <div class="chart-bar-segment info" style="height: 10%;"></div>
                        </div>
                        <span class="chart-day-label">Wed</span>
                    </div>
                    
                    <!-- Thursday -->
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar-stacked">
                            <div class="chart-bar-segment info" style="height: 10%;"></div>
                            <div class="chart-bar-segment warning" style="height: 20%;"></div>
                            <div class="chart-bar-segment critical" style="height: 40%;"></div>
                        </div>
                        <span class="chart-day-label">Thu</span>
                    </div>
                    
                    <!-- Friday -->
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar-stacked">
                            <div class="chart-bar-segment info" style="height: 10%;"></div>
                        </div>
                        <span class="chart-day-label">Fri</span>
                    </div>
                    
                    <!-- Saturday -->
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar-stacked">
                            <div class="chart-bar-segment info" style="height: 10%;"></div>
                        </div>
                        <span class="chart-day-label">Sat</span>
                    </div>
                    
                    <!-- Sunday -->
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar-stacked">
                            <div class="chart-bar-segment info" style="height: 15%;"></div>
                            <div class="chart-bar-segment warning" style="height: 25%;"></div>
                        </div>
                        <span class="chart-day-label">Sun</span>
                    </div>
                </div>
            </section>
            
        </div>
    </main>
</div>

<!-- Load JavaScript -->
<script src="assets/js/alerts.js"></script>

</body>
</html>
