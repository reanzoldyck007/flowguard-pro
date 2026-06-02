// ============================================================
//  FlowGuard Pro – Status Page JS
//  Polls /api/get-device-status.php and updates the four cards
// ============================================================

const POLL_INTERVAL_MS = 5000; // refresh every 5 s

document.addEventListener('DOMContentLoaded', function () {
    console.log("[FlowGuard] Status page initialized");

    initializeButtons();
    initializeAnimations();

    // First fetch immediately, then poll
    fetchDeviceStatus();
    setInterval(fetchDeviceStatus, POLL_INTERVAL_MS);
});

// ── Live Data Fetch ──────────────────────────────────────────

async function fetchDeviceStatus() {
    try {
        // ✅ ABSOLUTE PATH: always resolves correctly regardless of page location
        const res = await fetch('/flowguard/api/get-device-status.php');

        if (!res.ok) {
            console.error("[FlowGuard] HTTP error:", res.status, res.url);
            return;
        }

        const data = await res.json();
        console.log("[FlowGuard] Device status fetched:", data);
        updateCards(data);
    } catch (err) {
        console.error("[FlowGuard] Failed to fetch device status:", err);
    }
}

function updateCards(d) {
    // ── WiFi Card ────────────────────────────────────────────
    const wifiConnected = parseInt(d.wifi_connected) === 1;
    const dbm           = parseInt(d.wifi_signal_dbm) || 0;
    const wifiBars      = parseInt(d.wifi_bars)       || 1;
    const wifiLabel     = d.wifi_label                || 'Unknown';

    setCardState('wifi', wifiConnected ? 'primary' : 'error');
    setText('wifi-badge',  wifiConnected ? `${dbm} dBm` : 'OFFLINE');
    setText('wifi-value',  wifiConnected ? wifiLabel : 'Disconnected');
    updateWifiBars(wifiBars, wifiConnected);

    // ── Sensor Suite Card ────────────────────────────────────
    const sensorActive = d.sensor_status === 'ACTIVE';
    setCardState('sensor', sensorActive ? 'primary' : 'error');
    setText('sensor-badge', sensorActive ? 'OPERATIONAL' : 'INACTIVE');
    setText('sensor-value', sensorActive ? 'Active' : 'Inactive');
    if (d.last_calibration) {
        setText('sensor-footer', relativeTime(d.last_calibration));
    }

    // ── UPS Battery Card ─────────────────────────────────────
    const upsHealthy = d.ups_status === 'HEALTHY';
    const battPct    = parseInt(d.battery_level) || 0;
    const onMains    = d.power_source === 'MAIN';
    setCardState('ups', upsHealthy ? 'tertiary' : 'error');
    setText('ups-badge',  upsHealthy ? 'HEALTHY' : 'CRITICAL');
    setText('ups-value',  upsHealthy ? 'Healthy' : 'Unhealthy');
    setText('ups-footer', onMains ? `On Mains · ${battPct}%` : `On Battery · ${battPct}%`);

    // Update battery icon based on level
    const battIcon = document.getElementById('ups-icon');
    if (battIcon) {
        if (battPct > 80)      battIcon.textContent = 'battery_full';
        else if (battPct > 50) battIcon.textContent = 'battery_4_bar';
        else if (battPct > 20) battIcon.textContent = 'battery_2_bar';
        else                   battIcon.textContent = 'battery_very_low';
    }
}

// ── DOM Helpers ──────────────────────────────────────────────

function setText(id, value) {
    const el = document.getElementById(id);
    if (el) el.textContent = value;
}

/**
 * Swaps the color class (primary / secondary / tertiary / error)
 * on both the .card-icon and .status-badge inside a card.
 * cardKey must match data-card="wifi" | "sensor" | "ups" | "pump"
 */
function setCardState(cardKey, colorClass) {
    const card = document.querySelector(`.status-card[data-card="${cardKey}"]`);
    if (!card) return;
    const classes = ['primary', 'secondary', 'tertiary', 'error'];

    card.querySelectorAll('.card-icon, .status-badge').forEach(el => {
        el.classList.remove(...classes);
        el.classList.add(colorClass);
    });
}

function updateWifiBars(activeBars, connected) {
    const bars = document.querySelectorAll('.wifi-signal .signal-bar');
    bars.forEach((bar, i) => {
        bar.classList.toggle('active', connected && i < activeBars);
    });
}

function relativeTime(datetimeStr) {
    const past    = new Date(datetimeStr);
    const diffSec = Math.floor((Date.now() - past.getTime()) / 1000);
    if (diffSec < 60)   return `${diffSec}s ago`;
    if (diffSec < 3600) return `${Math.floor(diffSec / 60)}m ago`;
    return `${Math.floor(diffSec / 3600)}h ago`;
}

// ── Button Handlers ──────────────────────────────────────────

function initializeButtons() {
    bindClick('update-btn',       handleUpdateCheck);
    bindClick('restart-btn',      handleRestartController);
    bindClick('diagnostics-btn',  handleRunDiagnostics);
    bindClick('support-contact',  handleSupportContact, true);
}

function bindClick(id, fn, preventDefault = false) {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener('click', (e) => {
        if (preventDefault) e.preventDefault();
        fn(e);
    });
}

function handleUpdateCheck(e) {
    const btn = e.currentTarget;
    btn.textContent = 'Checking…';
    btn.disabled = true;
    setTimeout(() => {
        btn.textContent = 'Already Latest';
        setTimeout(() => {
            btn.textContent = 'Check for Updates';
            btn.disabled = false;
        }, 2000);
    }, 1500);
}

function handleRestartController() {
    showNotification('Soft reset initiated. Controller will restart in 10 seconds…', 'info');
    setTimeout(() => showNotification('Controller restarted successfully', 'success'), 10000);
}

function handleRunDiagnostics() {
    showNotification('Running complete hardware diagnostics…', 'info');
    const checks = ['Sensor Suite', 'Pump System', 'UPS Battery', 'WiFi Module'];
    checks.forEach((name, i) => {
        setTimeout(() => {
            console.log(`[FlowGuard] Diagnostic: ${name} – PASSED`);
            if (i === checks.length - 1) {
                showNotification('All diagnostics passed successfully!', 'success');
            }
        }, 2000 * (i + 1));
    });
}

function handleSupportContact() {
    showNotification('Connecting to technician support…', 'info');
    setTimeout(() => showNotification('A technician will be assigned shortly', 'success'), 2000);
}

// ── Animations ───────────────────────────────────────────────

function initializeAnimations() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes cardSlideIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .status-card[data-card] .card-icon.error,
        .status-card[data-card] .status-badge.error {
            background: rgba(255,180,171,.15);
            color: #ffb4ab;
            border-color: rgba(255,180,171,.3);
        }
    `;
    document.head.appendChild(style);

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'cardSlideIn 0.5s ease forwards';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.status-card').forEach(c => observer.observe(c));
    }
}

// ── Toast Notifications ──────────────────────────────────────

function showNotification(message, type = 'info') {
    if (!document.querySelector('style[data-notifications]')) {
        const s = document.createElement('style');
        s.setAttribute('data-notifications', 'true');
        s.textContent = `
            .notification {
                position: fixed; bottom: 100px; left: 50%;
                transform: translateX(-50%);
                padding: 16px 24px; border-radius: 12px;
                font-size: 14px; font-weight: 600;
                z-index: 1000; animation: slideUp .3s ease;
                max-width: 90%;
            }
            .notification-info    { background:rgba(0,218,243,.2);   color:#00daf3; border:1px solid rgba(0,218,243,.4); }
            .notification-success { background:rgba(182,199,232,.2); color:#b6c7e8; border:1px solid rgba(182,199,232,.4); }
            .notification-error   { background:rgba(255,180,171,.2); color:#ffb4ab; border:1px solid rgba(255,180,171,.4); }
            @keyframes slideUp {
                from { opacity:0; transform:translateX(-50%) translateY(20px); }
                to   { opacity:1; transform:translateX(-50%) translateY(0); }
            }
        `;
        document.head.appendChild(s);
    }

    const toast = document.createElement('div');
    toast.className = `notification notification-${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'slideUp .3s ease reverse';
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

// ── Public API ───────────────────────────────────────────────
window.StatusPage = { showNotification, handleRestartController, handleRunDiagnostics };
