/**
 * FlowGuard Pro Dashboard – index.js
 * Live data updates every 1 second with proper intervals
 */

// ─── Live Data State ──────────────────────────────────────────────────────────

let liveData = {
    waterTemp: 18,
    ammonia: 0.40,
    oxygen: 6.8,
    quality: 'Excellent',
    pump: 'ON',
    power: 'MAIN',
    filter: { label: 'Good', days: 28 },
    light: 850,
    battery: 85,
    health: 94,
};

// ─── Sensor Value Cycles & Indices ────────────────────────────────────────────

const sensorCycles = {
    waterTemp: [18, 24, 34],
    tempIndex: 0,
    
    ammonia: [0.40, 2.10, 4.50],
    ammoniaIndex: 0,
    
    oxygen: [6.8, 8.3, 5.1],
    
    quality: ['Excellent', 'Good', 'Fair', 'Poor'],
    qualityIndex: 0,
    
    pump: ['ON', 'OFF'],
    pumpIndex: 0,
    
    power: ['MAIN', 'BATTERY'],
    powerIndex: 0,
    
    filter: [
        { label: 'Good', days: 28 },
        { label: 'Fair', days: 14 },
        { label: 'Replace', days: 2 }
    ],
    filterIndex: 0,
    
    light: [850, 640, 920, 310],
};

// ─── Chart Data Storage ───────────────────────────────────────────────────────

const chartData = {
    labels: [],
    temp: [],
    ammonia: [],
};

const CHART_HISTORY_LEN = 40;

// ─── Update All UI Values ─────────────────────────────────────────────────────

function updateUI() {
    // Health Score
    const healthEl = document.querySelector('.metric-number');
    if (healthEl) healthEl.textContent = liveData.health;
    
    // Battery
    const batteryPercentEl = document.querySelector('.battery-percent');
    if (batteryPercentEl) batteryPercentEl.textContent = liveData.battery + '%';
    
    const batteryFillEl = document.querySelector('.battery-fill');
    if (batteryFillEl) batteryFillEl.style.width = liveData.battery + '%';
    
    // Water Temp
    const tempEl = document.querySelector('[data-metric="temp"]');
    if (tempEl) tempEl.textContent = liveData.waterTemp + '°C';
    
    // Ammonia
    const ammoniaEl = document.querySelector('[data-metric="ammonia"]');
    if (ammoniaEl) ammoniaEl.textContent = liveData.ammonia.toFixed(2) + ' ppm';
    
    // Oxygen
    const oxygenEl = document.querySelector('[data-metric="oxygen"]');
    if (oxygenEl) oxygenEl.textContent = liveData.oxygen.toFixed(1) + ' mg/L';
    
    // Quality
    const qualityEl = document.querySelector('[data-metric="quality"]');
    if (qualityEl) qualityEl.textContent = liveData.quality;
    
    // Pump
    const pumpEl = document.querySelector('[data-metric="pump"]');
    if (pumpEl) pumpEl.textContent = liveData.pump;
    
    // Power
    const powerEl = document.querySelector('[data-metric="power"]');
    if (powerEl) powerEl.textContent = liveData.power;
    
    // Filter
    const filterEl = document.querySelector('[data-metric="filter"]');
    if (filterEl) filterEl.textContent = liveData.filter.label;
    
    const filterDaysEl = document.querySelector('[data-metric="filter-days"]');
    if (filterDaysEl) filterDaysEl.textContent = 'Next replacement: ' + liveData.filter.days + ' days';
    
    // Light
    const lightEl = document.querySelector('[data-metric="light"]');
    if (lightEl) lightEl.textContent = liveData.light + ' lux';
    
    // Last Updated
    const lastUpdatedEl = document.querySelector('[data-metric="updated"]');
    if (lastUpdatedEl) {
        const now = new Date();
        lastUpdatedEl.textContent = now.toLocaleTimeString();
    }
}

// ─── Chart Drawing ────────────────────────────────────────────────────────────

function drawChart() {
    const canvas = document.querySelector('canvas.chart-canvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const w = canvas.width;
    const h = canvas.height;
    
    // Clear canvas
    ctx.clearRect(0, 0, w, h);
    
    // Draw grid lines
    ctx.strokeStyle = 'rgba(186, 201, 204, 0.1)';
    ctx.lineWidth = 1;
    for (let i = 1; i < 5; i++) {
        const y = (h / 5) * i;
        ctx.beginPath();
        ctx.moveTo(0, y);
        ctx.lineTo(w, y);
        ctx.stroke();
    }
    
    if (chartData.temp.length < 2) return;
    
    // Draw temperature line
    ctx.strokeStyle = '#00daf3';
    ctx.lineWidth = 3;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    
    const tempMin = 0, tempMax = 40;
    const xStep = w / CHART_HISTORY_LEN;
    
    ctx.beginPath();
    for (let i = 0; i < chartData.temp.length; i++) {
        const x = i * xStep;
        const y = h - ((chartData.temp[i] - tempMin) / (tempMax - tempMin)) * h;
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    }
    ctx.stroke();
    
    // Draw ammonia line (dashed)
    ctx.strokeStyle = '#94ccff';
    ctx.setLineDash([8, 4]);
    ctx.lineWidth = 2;
    
    const ammoniaMin = 0, ammoniaMax = 5;
    
    ctx.beginPath();
    for (let i = 0; i < chartData.ammonia.length; i++) {
        const x = i * xStep;
        const y = h - ((chartData.ammonia[i] - ammoniaMin) / (ammoniaMax - ammoniaMin)) * h;
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    }
    ctx.stroke();
    ctx.setLineDash([]);
}

// ─── Add Chart Data Point ─────────────────────────────────────────────────────

function pushChartPoint() {
    chartData.temp.push(liveData.waterTemp);
    chartData.ammonia.push(liveData.ammonia);
    
    const now = new Date();
    chartData.labels.push(now.toLocaleTimeString([], { 
        hour: '2-digit', minute: '2-digit', second: '2-digit' 
    }));
    
    if (chartData.temp.length > CHART_HISTORY_LEN) {
        chartData.temp.shift();
        chartData.ammonia.shift();
        chartData.labels.shift();
    }
    
    drawChart();
}

// ─── DOM Ready & Initialize ───────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', function() {
    // Inject canvas if it doesn't exist
    const chartContent = document.querySelector('.chart-content');
    if (chartContent && !document.querySelector('canvas.chart-canvas')) {
        const canvas = document.createElement('canvas');
        canvas.className = 'chart-canvas';
        canvas.width = chartContent.clientWidth;
        canvas.height = 200;
        chartContent.appendChild(canvas);
    }
    
    // Initial update
    updateUI();
    pushChartPoint();
    
    let startTime = Date.now();
    
    // Master update loop: every 1 second
    setInterval(() => {
        const elapsedMs = Date.now() - startTime;
        
        // Water Temp: cycle every 5 seconds
        if (Math.floor(elapsedMs / 5000) !== Math.floor((elapsedMs - 1000) / 5000)) {
            sensorCycles.tempIndex = (sensorCycles.tempIndex + 1) % sensorCycles.waterTemp.length;
            liveData.waterTemp = sensorCycles.waterTemp[sensorCycles.tempIndex];
        }
        
        // Ammonia: cycle every 3 seconds
        if (Math.floor(elapsedMs / 3000) !== Math.floor((elapsedMs - 1000) / 3000)) {
            sensorCycles.ammoniaIndex = (sensorCycles.ammoniaIndex + 1) % sensorCycles.ammonia.length;
            liveData.ammonia = sensorCycles.ammonia[sensorCycles.ammoniaIndex];
        }
        
        // Oxygen: random pick every 6 seconds
        if (Math.floor(elapsedMs / 6000) !== Math.floor((elapsedMs - 1000) / 6000)) {
            liveData.oxygen = sensorCycles.oxygen[Math.floor(Math.random() * sensorCycles.oxygen.length)];
        }
        
        // Quality: cycle every 5 seconds
        if (Math.floor(elapsedMs / 5000) !== Math.floor((elapsedMs - 1000) / 5000)) {
            sensorCycles.qualityIndex = (sensorCycles.qualityIndex + 1) % sensorCycles.quality.length;
            liveData.quality = sensorCycles.quality[sensorCycles.qualityIndex];
        }
        
        // Pump: toggle every 10 seconds
        if (Math.floor(elapsedMs / 10000) !== Math.floor((elapsedMs - 1000) / 10000)) {
            sensorCycles.pumpIndex = (sensorCycles.pumpIndex + 1) % sensorCycles.pump.length;
            liveData.pump = sensorCycles.pump[sensorCycles.pumpIndex];
        }
        
        // Power: toggle every 10 seconds
        if (Math.floor(elapsedMs / 10000) !== Math.floor((elapsedMs - 1000) / 10000)) {
            sensorCycles.powerIndex = (sensorCycles.powerIndex + 1) % sensorCycles.power.length;
            liveData.power = sensorCycles.power[sensorCycles.powerIndex];
        }
        
        // Filter: cycle every 6 seconds
        if (Math.floor(elapsedMs / 6000) !== Math.floor((elapsedMs - 1000) / 6000)) {
            sensorCycles.filterIndex = (sensorCycles.filterIndex + 1) % sensorCycles.filter.length;
            liveData.filter = sensorCycles.filter[sensorCycles.filterIndex];
        }
        
        // Light: cycle every 4 seconds
        if (Math.floor(elapsedMs / 4000) !== Math.floor((elapsedMs - 1000) / 4000)) {
            const currentLightIndex = Math.floor((Date.now() / 4000) % sensorCycles.light.length);
            liveData.light = sensorCycles.light[currentLightIndex];
        }
        
        // Update UI and chart
        updateUI();
        pushChartPoint();
    }, 1000);
});
