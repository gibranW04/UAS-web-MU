import Chart from 'chart.js/auto';
import { createIcons } from 'lucide';

window.lucideCreateIcons = createIcons;

let chartInstances = {};

function getChartColors() {
    const isDark = document.documentElement.classList.contains('dark');
    return {
        text: isDark ? '#94a3b8' : '#64748b',
        grid: isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)',
        red: '#DA291C',
        redBg: isDark ? 'rgba(218,41,28,0.3)' : 'rgba(218,41,28,0.15)',
        amber: isDark ? '#fbbf24' : '#f59e0b',
        amberBg: isDark ? 'rgba(251,191,36,0.3)' : 'rgba(245,158,11,0.15)',
        emerald: isDark ? '#34d399' : '#10b981',
        emeraldBg: isDark ? 'rgba(52,211,153,0.3)' : 'rgba(16,185,129,0.15)',
        bg: isDark ? '#1e293b' : '#ffffff',
    };
}

function formatRp(value) {
    return 'Rp ' + value.toLocaleString('id-ID');
}

function formatMillions(value) {
    if (value >= 1000000000) return 'Rp' + (value / 1000000000).toFixed(1) + 'B';
    if (value >= 1000000) return 'Rp' + (value / 1000000).toFixed(1) + 'M';
    if (value >= 1000) return 'Rp' + (value / 1000).toFixed(1) + 'K';
    return 'Rp' + value;
}

function tooltipOpts() {
    const c = getChartColors();
    return {
        backgroundColor: c.bg,
        titleColor: c.text,
        bodyColor: c.text,
        borderColor: c.grid,
        borderWidth: 1,
    };
}

function scaleDefaults() {
    const c = getChartColors();
    return {
        y: {
            beginAtZero: true,
            grid: { color: c.grid },
            ticks: { color: c.text, callback: v => formatMillions(v) },
        },
        x: {
            grid: { display: false },
            ticks: { color: c.text },
        },
    };
}

window.initAdminCharts = function (data) {
    if (!data) return;
    destroyCharts();
    const c = getChartColors();

    // Monthly Sales
    const mCtx = document.getElementById('monthlyChart');
    if (mCtx) {
        chartInstances.monthly = new Chart(mCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.monthlyLabels,
                datasets: [{
                    label: 'Sales',
                    data: data.monthlyData,
                    backgroundColor: c.redBg,
                    borderColor: c.red,
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { ...tooltipOpts(), callbacks: { label: ctx => formatRp(ctx.parsed.y) } },
                },
                scales: scaleDefaults(),
            },
        });
    }

    // Revenue Trend
    const rCtx = document.getElementById('revenueChart');
    if (rCtx) {
        chartInstances.revenue = new Chart(rCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: data.revenueLabels,
                datasets: [{
                    label: 'Revenue',
                    data: data.revenueData,
                    borderColor: c.red,
                    backgroundColor: c.redBg,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: c.red,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { ...tooltipOpts(), callbacks: { label: ctx => formatRp(ctx.parsed.y) } },
                },
                scales: scaleDefaults(),
            },
        });
    }

    // Weekly Sales
    const wCtx = document.getElementById('weeklyChart');
    if (wCtx) {
        chartInstances.weekly = new Chart(wCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: data.weeklyLabels,
                datasets: [{
                    label: 'Sales',
                    data: data.weeklyData,
                    backgroundColor: c.amberBg,
                    borderColor: c.amber,
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { ...tooltipOpts(), callbacks: { label: ctx => formatRp(ctx.parsed.y) } },
                },
                scales: scaleDefaults(),
            },
        });
    }

    // Customer Growth
    const cCtx = document.getElementById('customerGrowthChart');
    if (cCtx) {
        chartInstances.customerGrowth = new Chart(cCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: data.revenueLabels,
                datasets: [{
                    label: 'New Customers',
                    data: data.customerGrowth,
                    borderColor: c.emerald,
                    backgroundColor: c.emeraldBg,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: c.emerald,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: tooltipOpts(),
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: c.grid },
                        ticks: { color: c.text, stepSize: 1 },
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: c.text },
                    },
                },
            },
        });
    }
};

function destroyCharts() {
    Object.values(chartInstances).forEach(chart => {
        if (chart) chart.destroy();
    });
    chartInstances = {};
}

window.reinitAdminCharts = function () {
    const data = window.adminChartData;
    if (data) window.initAdminCharts(data);
};

document.addEventListener('DOMContentLoaded', () => {
    createIcons();
    document.querySelectorAll('.stat-number').forEach(el => {
        const target = parseInt(el.dataset.target);
        const duration = 1000;
        let startTime = null;
        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target).toLocaleString('id-ID');
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    });
    if (window.adminChartData) window.initAdminCharts(window.adminChartData);
});
