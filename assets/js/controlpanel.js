/**
 * Control Panel JavaScript
 * Handles pump controls, temperature thresholds, and system management
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('[v0] Control Panel initialized');
    
    // Initialize all interactive components
    initializePumpControl();
    initializeTemperatureSliders();
    initializeAmmoniaControls();
    initializeAutoResponseSystem();
    initializeToggleSwitch();
});

/**
 * Initialize pump control functionality
 */
function initializePumpControl() {
    console.log('[v0] Setting up pump control');
    
    const pumpBtn = document.querySelector('.pump-toggle-btn');
    if (pumpBtn) {
        pumpBtn.addEventListener('click', function() {
            togglePumpState();
        });
    }
}

/**
 * Toggle pump state with confirmation
 */
function togglePumpState() {
    const stateValue = document.querySelector('.state-value');
    const currentState = stateValue.textContent.trim();
    const newState = currentState === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
    
    console.log('[v0] Toggling pump from', currentState, 'to', newState);
    
    // Visual feedback
    const btn = document.querySelector('.pump-toggle-btn');
    btn.style.opacity = '0.7';
    
    setTimeout(() => {
        stateValue.textContent = newState;
        btn.style.opacity = '1';
        console.log('[v0] Pump state updated to:', newState);
    }, 300);
}

/**
 * Initialize temperature slider controls
 */
function initializeTemperatureSliders() {
    console.log('[v0] Initializing temperature sliders');
    
    const sliders = document.querySelectorAll('.temp-slider');
    sliders.forEach(slider => {
        slider.addEventListener('input', function() {
            const type = this.getAttribute('data-type');
            const value = this.value;
            
            // Update display value
            const reading = this.parentElement.querySelector('.temp-reading');
            if (reading) {
                reading.textContent = value + '°C';
            }
            
            console.log('[v0] Temperature', type, 'adjusted to:', value + '°C');
        });
        
        slider.addEventListener('change', function() {
            const type = this.getAttribute('data-type');
            const value = this.value;
            saveTemperatureSetting(type, value);
        });
    });
}

/**
 * Save temperature setting (simulated API call)
 */
function saveTemperatureSetting(type, value) {
    console.log('[v0] Saving temperature', type, 'setting:', value + '°C');
    // In production, this would call a backend API
}

/**
 * Initialize ammonia sensitivity controls
 */
function initializeAmmoniaControls() {
    console.log('[v0] Initializing ammonia controls');
    
    const minusBtn = document.querySelector('.ammonia-btn.minus-btn');
    const plusBtn = document.querySelector('.ammonia-btn.plus-btn');
    const valueNumber = document.querySelector('.value-number');
    
    if (minusBtn && plusBtn && valueNumber) {
        minusBtn.addEventListener('click', function() {
            let current = parseFloat(valueNumber.textContent);
            let newValue = Math.max(0.1, current - 0.1).toFixed(1);
            valueNumber.textContent = newValue;
            updateIndicators(newValue);
            console.log('[v0] Ammonia sensitivity decreased to:', newValue);
        });
        
        plusBtn.addEventListener('click', function() {
            let current = parseFloat(valueNumber.textContent);
            let newValue = Math.min(5.0, current + 0.1).toFixed(1);
            valueNumber.textContent = newValue;
            updateIndicators(newValue);
            console.log('[v0] Ammonia sensitivity increased to:', newValue);
        });
    }
}

/**
 * Update sensitivity indicator bars
 */
function updateIndicators(value) {
    const bars = document.querySelectorAll('.indicator-bar');
    const filledCount = Math.ceil(parseFloat(value) / 5.0 * 5);
    
    bars.forEach((bar, index) => {
        if (index < filledCount) {
            bar.classList.add('filled');
        } else {
            bar.classList.remove('filled');
        }
    });
}

/**
 * Initialize auto-response system toggle
 */
function initializeAutoResponseSystem() {
    console.log('[v0] Initializing auto-response system');
    
    // Auto-response toggle would be handled here
}

/**
 * Initialize toggle switch functionality
 */
function initializeToggleSwitch() {
    console.log('[v0] Initializing toggle switch');
    
    const toggleTrack = document.querySelector('.toggle-track');
    if (toggleTrack) {
        toggleTrack.addEventListener('click', function() {
            const thumb = this.querySelector('.toggle-thumb');
            const currentTransform = thumb.style.transform;
            
            if (currentTransform === 'translateX(24px)') {
                thumb.style.transform = 'translateX(0)';
                console.log('[v0] Auto-response system disabled');
            } else {
                thumb.style.transform = 'translateX(24px)';
                console.log('[v0] Auto-response system enabled');
            }
        });
    }
}

/**
 * Handle critical system alerts
 */
function handleSystemAlert(level, message) {
    console.log('[v0] System alert [' + level + ']:', message);
    // In production, show notification to user
}

/**
 * Update real-time telemetry
 */
function updateTelemetry(data) {
    console.log('[v0] Updating telemetry:', data);
    // Update any live values shown on the page
}

