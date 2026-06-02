/**
 * FlowGuard Pro - Alerts Page JavaScript
 * Handles alert interactions, toggle buttons, and dynamic behavior
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize toggle buttons
    initializeToggles();
    
    // Initialize alert buttons
    initializeAlertButtons();
    
    // Initialize theme toggle
    initializeThemeToggle();
});

/**
 * Initialize toggle button functionality
 */
function initializeToggles() {
    const toggleButtons = document.querySelectorAll('.toggle-button');
    
    toggleButtons.forEach(button => {
        // Set initial state based on data attribute or class
        if (button.classList.contains('active')) {
            button.setAttribute('data-active', 'true');
        }
        
        button.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('active');
            const isActive = this.classList.contains('active');
            this.setAttribute('data-active', isActive);
            
            // Get the parent toggle item to find the label
            const parent = this.closest('.toggle-item');
            if (parent) {
                const label = parent.querySelector('.toggle-label')?.textContent || '';
                console.log(`[v0] ${label} toggle: ${isActive ? 'ON' : 'OFF'}`);
            }
        });
    });
}

/**
 * Initialize alert button functionality
 */
function initializeAlertButtons() {
    const alertButtons = document.querySelectorAll('.alert-button');
    
    alertButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const alertCard = this.closest('.alert-card');
            if (!alertCard) return;
            
            // Get alert info
            const alertTitle = alertCard.querySelector('.alert-title')?.textContent || 'Unknown Alert';
            const buttonText = this.textContent.trim();
            
            // Different actions based on button text
            if (buttonText === 'Resolve') {
                resolveAlert(alertCard, alertTitle);
            } else if (buttonText === 'View Data' || buttonText === 'Details') {
                console.log(`[v0] Viewing details for: ${alertTitle}`);
                // In a real app, this would navigate to a details page
            }
        });
    });
}

/**
 * Handle alert resolution
 */
function resolveAlert(alertCard, alertTitle) {
    console.log(`[v0] Resolving alert: ${alertTitle}`);
    
    // Add a fade-out animation
    alertCard.style.opacity = '0';
    alertCard.style.transform = 'translateX(20px)';
    alertCard.style.transition = 'all 0.3s ease-out';
    
    setTimeout(() => {
        alertCard.remove();
        console.log(`[v0] Alert removed from view: ${alertTitle}`);
        
        // Check if there are any remaining alerts
        const remainingAlerts = document.querySelectorAll('.alert-card');
        if (remainingAlerts.length === 0) {
            console.log('[v0] No more alerts to display');
        }
    }, 300);
}

/**
 * Initialize theme toggle button
 */
function initializeThemeToggle() {
    const themeBtn = document.querySelector('.theme-btn');
    
    if (themeBtn) {
        themeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const htmlElement = document.documentElement;
            const isDark = htmlElement.classList.contains('dark');
            
            if (isDark) {
                htmlElement.classList.remove('dark');
                console.log('[v0] Theme switched to light');
            } else {
                htmlElement.classList.add('dark');
                console.log('[v0] Theme switched to dark');
            }
            
            // Store preference
            localStorage.setItem('theme-preference', isDark ? 'light' : 'dark');
        });
    }
}

/**
 * Initialize notification button
 */
function initializeNotificationButton() {
    const notificationBtn = document.querySelector('.notification-btn');
    
    if (notificationBtn) {
        notificationBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('[v0] Notification panel opened');
            // In a real app, this would show a notification panel
        });
    }
}

/**
 * Handle alert card hover effects (optional enhancement)
 */
function initializeAlertHoverEffects() {
    const alertCards = document.querySelectorAll('.alert-card');
    
    alertCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

/**
 * Utility: Format timestamp (if needed for dynamic alerts)
 */
function formatAlertTime(date) {
    const now = new Date();
    const diff = now - date;
    const minutes = Math.floor(diff / 60000);
    const hours = Math.floor(diff / 3600000);
    const days = Math.floor(diff / 86400000);
    
    if (minutes < 60) {
        return `${minutes}m ago`;
    } else if (hours < 24) {
        return `${hours}h ago`;
    } else if (days < 7) {
        return `${days}d ago`;
    } else {
        return date.toLocaleDateString();
    }
}

/**
 * Utility: Add new alert to the list (for real-time updates)
 */
function addAlert(alertData) {
    const alertContainer = document.querySelector('.alert-cards-container');
    if (!alertContainer) return;
    
    const alertCard = document.createElement('div');
    alertCard.className = `alert-card glass-card ${alertData.severity}`;
    
    const iconMap = {
        critical: 'power_off',
        warning: 'warning',
        info: 'check_circle'
    };
    
    const buttonMap = {
        critical: 'Resolve',
        warning: 'View Data',
        info: 'Details'
    };
    
    alertCard.innerHTML = `
        <div class="alert-content">
            <div class="alert-icon-container status-pulse">
                <span class="material-symbols-outlined">${iconMap[alertData.severity] || 'info'}</span>
            </div>
            <div class="alert-text">
                <div class="alert-header">
                    <span class="alert-badge ${alertData.severity}">${alertData.severity.toUpperCase()}</span>
                    <span class="alert-timestamp">${alertData.timestamp || 'Just now'}</span>
                </div>
                <h4 class="alert-title">${alertData.title}</h4>
                <p class="alert-description">${alertData.description}</p>
            </div>
        </div>
        <button class="alert-button ${alertData.severity === 'critical' ? 'critical' : 'secondary'}">
            ${buttonMap[alertData.severity] || 'View'}
        </button>
    `;
    
    alertContainer.insertBefore(alertCard, alertContainer.firstChild);
    
    // Reinitialize button for new alert
    const newButton = alertCard.querySelector('.alert-button');
    newButton.addEventListener('click', function(e) {
        e.preventDefault();
        if (alertData.severity === 'critical') {
            resolveAlert(alertCard, alertData.title);
        }
    });
    
    console.log(`[v0] New alert added: ${alertData.title}`);
}

// Export functions for external use if needed
window.AlertsModule = {
    addAlert: addAlert,
    formatAlertTime: formatAlertTime,
    resolveAlert: resolveAlert
};
