<?php
/**
 * Navigation Component
 * Fixed sidebar navigation menu
 */
?>

<!-- SideNavBar -->
<aside>
    <div class="nav-brand">
        <div class="nav-brand-icon">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">waves</span>
        </div>
        <div>
            <h1>FlowGuard Pro</h1>
            <p>System Active</p>
        </div>
    </div>
    
    <nav>
        <a href="index.php" class="nav-link">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
        </a>
        <a href="controlpanel.php" class="nav-link">
            <span class="material-symbols-outlined">settings_input_component</span>
            <span>Control Panel</span>
        </a>
        <a href="alerts.php" class="nav-link">
            <span class="material-symbols-outlined">notifications_active</span>
            <span>Alerts</span>
        </a>
        <a href="analytics.php" class="nav-link">
            <span class="material-symbols-outlined">analytics</span>
            <span>Analytics</span>
        </a>
        <a href="status.php" class="nav-link">
            <span class="material-symbols-outlined">router</span>
            <span>Device Status</span>
        </a>
    </nav>
    
    <div class="nav-user">
        <div class="glass-panel user-profile">
            <div class="user-avatar">
                <span class="material-symbols-outlined" style="font-size: 18px;">person</span>
            </div>
            <div class="user-info">
                <p class="user-name">Master Aquarist</p>
                <p class="user-plan">Premium Plan</p>
            </div>
            <span class="material-symbols-outlined">settings</span>
        </div>
    </div>
</aside>
