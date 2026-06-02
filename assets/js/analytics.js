/**
 * FlowGuard Pro - Analytics Page JavaScript
 * Handles interactivity and dynamic features for analytics page
 */

(function() {
    'use strict';

    // ============================================
    // Initialize Analytics Page
    // ============================================

    document.addEventListener('DOMContentLoaded', function() {
        initializeAnalyticsPage();
    });

    function initializeAnalyticsPage() {
        setupEventListeners();
        initializeCharts();
        setupAnimations();
        setupResponsiveHandling();
    }

    // ============================================
    // Event Listeners
    // ============================================

    function setupEventListeners() {
        // PDF Report Button
        const pdfBtn = document.querySelector('.btn-primary');
        if (pdfBtn) {
            pdfBtn.addEventListener('click', handleGeneratePDF);
        }

        // History Button
        const historyBtn = document.querySelector('.btn-secondary');
        if (historyBtn) {
            historyBtn.addEventListener('click', handleShowHistory);
        }

        // Fullscreen Buttons
        const fullscreenBtns = document.querySelectorAll('.fullscreen-btn');
        fullscreenBtns.forEach(btn => {
            btn.addEventListener('click', handleFullscreen);
        });

        // Mobile Navigation
        const mobileNavBtns = document.querySelectorAll('.mobile-nav-btn');
        mobileNavBtns.forEach((btn, index) => {
            btn.addEventListener('click', function() {
                handleMobileNavClick(this, index);
            });
        });

        // Hover effects on insight cards
        const insightCards = document.querySelectorAll('.insight-card');
        insightCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
                this.style.boxShadow = '0 8px 24px rgba(0, 229, 255, 0.1)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });

        // Hover effects on bars
        const barItems = document.querySelectorAll('.bar-item');
        barItems.forEach(item => {
            const bar = item.querySelector('.bar');
            item.addEventListener('mouseenter', function() {
                // Show tooltip on hover (optional)
                showBarTooltip(this);
            });
            item.addEventListener('mouseleave', function() {
                hideBarTooltip(this);
            });
        });

        // Chart card hover effects
        const chartCards = document.querySelectorAll('.chart-card');
        chartCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 8px 24px rgba(0, 229, 255, 0.08)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
    }

    // ============================================
    // Button Handlers
    // ============================================

    function handleGeneratePDF() {
        console.log('[Analytics] Generating PDF report...');
        // In a real app, this would generate and download a PDF
        showNotification('PDF report generation started', 'success');
        setTimeout(() => {
            showNotification('PDF report downloaded successfully', 'success');
        }, 2000);
    }

    function handleShowHistory() {
        console.log('[Analytics] Showing history...');
        showNotification('Loading analytics history', 'info');
        // In a real app, this would open a modal or navigate to history page
    }

    function handleFullscreen(e) {
        const card = e.currentTarget.closest('.chart-card');
        if (card) {
            const isFullscreen = card.classList.toggle('fullscreen');
            if (isFullscreen) {
                console.log('[Analytics] Entering fullscreen mode for chart');
                // Expand chart to fullscreen
                card.style.position = 'fixed';
                card.style.top = '0';
                card.style.left = '0';
                card.style.width = '100vw';
                card.style.height = '100vh';
                card.style.zIndex = '1000';
                card.style.borderRadius = '0';
                document.body.style.overflow = 'hidden';
                
                // Add close button
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '✕';
                closeBtn.style.position = 'fixed';
                closeBtn.style.top = '20px';
                closeBtn.style.right = '20px';
                closeBtn.style.width = '40px';
                closeBtn.style.height = '40px';
                closeBtn.style.background = 'rgba(255, 255, 255, 0.1)';
                closeBtn.style.border = 'none';
                closeBtn.style.color = '#e0e3e5';
                closeBtn.style.fontSize = '24px';
                closeBtn.style.borderRadius = '8px';
                closeBtn.style.cursor = 'pointer';
                closeBtn.style.zIndex = '1001';
                closeBtn.addEventListener('click', function() {
                    exitFullscreen(card);
                });
                document.body.appendChild(closeBtn);
            } else {
                exitFullscreen(card);
            }
        }
    }

    function exitFullscreen(card) {
        console.log('[Analytics] Exiting fullscreen mode');
        card.style.position = 'relative';
        card.style.top = 'auto';
        card.style.left = 'auto';
        card.style.width = '100%';
        card.style.height = 'auto';
        card.style.zIndex = 'auto';
        card.style.borderRadius = 'var(--radius-xl)';
        document.body.style.overflow = 'auto';
        
        // Remove close button
        const closeBtn = document.querySelector('[style*="1001"]');
        if (closeBtn) {
            closeBtn.remove();
        }
    }

    function handleMobileNavClick(btn, index) {
        console.log('[Analytics] Mobile nav clicked - index:', index);
        
        // Remove active class from all buttons
        document.querySelectorAll('.mobile-nav-btn').forEach(b => {
            b.classList.remove('active');
        });
        
        // Add active class to clicked button
        btn.classList.add('active');
        
        // Navigation mapping
        const routes = [
            '#dashboard',
            '#control-panel',
            '#analytics',
            '#alerts',
            '#profile'
        ];
        
        // In a real app, this would navigate to the route
        console.log('[Analytics] Navigating to:', routes[index]);
    }

    // ============================================
    // Chart Initialization
    // ============================================

    function initializeCharts() {
        console.log('[Analytics] Initializing charts');
        
        // Animate chart SVG paths on load
        animateChartPaths();
        
        // Initialize bar chart animations
        animateBarChart();
        
        // Initialize health metrics animations
        animateHealthMetrics();
    }

    function animateChartPaths() {
        const svgs = document.querySelectorAll('.chart-svg');
        svgs.forEach(svg => {
            const paths = svg.querySelectorAll('path');
            paths.forEach(path => {
                const length = path.getTotalLength();
                path.style.strokeDasharray = length;
                path.style.strokeDashoffset = length;
                path.style.transition = 'stroke-dashoffset 1.5s ease-in-out';
                
                // Trigger animation
                setTimeout(() => {
                    path.style.strokeDashoffset = '0';
                }, 100);
            });
        });
    }

    function animateBarChart() {
        const bars = document.querySelectorAll('.bar');
        bars.forEach((bar, index) => {
            const originalHeight = bar.style.height;
            bar.style.height = '0';
            setTimeout(() => {
                bar.style.transition = 'height 0.6s ease-out';
                bar.style.height = originalHeight;
            }, 100 + index * 100);
        });
    }

    function animateHealthMetrics() {
        const healthFills = document.querySelectorAll('.health-fill');
        healthFills.forEach((fill, index) => {
            const originalWidth = fill.style.width;
            fill.style.width = '0';
            setTimeout(() => {
                fill.style.transition = 'width 0.8s ease-out';
                fill.style.width = originalWidth;
            }, 100 + index * 150);
        });
    }

    // ============================================
    // Tooltip Functions
    // ============================================

    function showBarTooltip(barItem) {
        const bar = barItem.querySelector('.bar');
        const height = parseInt(bar.style.height);
        const hours = Math.round((height / 100) * 24);
        
        // Create tooltip
        const tooltip = document.createElement('div');
        tooltip.style.position = 'absolute';
        tooltip.style.bottom = 'calc(100% + 8px)';
        tooltip.style.left = '50%';
        tooltip.style.transform = 'translateX(-50%)';
        tooltip.style.background = 'var(--color-surface)';
        tooltip.style.color = 'var(--color-on-surface)';
        tooltip.style.padding = '4px 8px';
        tooltip.style.borderRadius = '4px';
        tooltip.style.fontSize = '10px';
        tooltip.style.fontWeight = 'bold';
        tooltip.style.whiteSpace = 'nowrap';
        tooltip.style.zIndex = '100';
        tooltip.innerHTML = `${hours}h`;
        
        barItem.style.position = 'relative';
        barItem.appendChild(tooltip);
    }

    function hideBarTooltip(barItem) {
        const tooltip = barItem.querySelector('div[style*="absolute"]');
        if (tooltip) {
            tooltip.remove();
        }
    }

    // ============================================
    // Animations
    // ============================================

    function setupAnimations() {
        // Animate insight cards on scroll into view
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.insight-card, .chart-card, .power-chart-card, .system-health-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    }

    // ============================================
    // Responsive Handling
    // ============================================

    function setupResponsiveHandling() {
        // Handle window resize
        window.addEventListener('resize', debounce(handleWindowResize, 250));
        
        // Initial responsive check
        handleWindowResize();
    }

    function handleWindowResize() {
        const width = window.innerWidth;
        console.log('[Analytics] Window resized to:', width);
        
        // Adjust chart heights based on screen size
        if (width < 768) {
            document.querySelectorAll('.chart-content').forEach(chart => {
                chart.style.height = '150px';
            });
        } else {
            document.querySelectorAll('.chart-content').forEach(chart => {
                chart.style.height = '256px';
            });
        }
    }

    // ============================================
    // Utility Functions
    // ============================================

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function showNotification(message, type = 'info') {
        console.log(`[Analytics] Notification (${type}):`, message);
        
        // Create notification element
        const notification = document.createElement('div');
        notification.style.position = 'fixed';
        notification.style.bottom = '20px';
        notification.style.right = '20px';
        notification.style.background = type === 'success' 
            ? 'rgba(0, 229, 255, 0.2)' 
            : 'rgba(0, 229, 255, 0.1)';
        notification.style.border = '1px solid rgba(0, 229, 255, 0.3)';
        notification.style.color = 'var(--color-on-surface)';
        notification.style.padding = '16px 20px';
        notification.style.borderRadius = '8px';
        notification.style.fontSize = '14px';
        notification.style.zIndex = '9999';
        notification.innerHTML = message;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // ============================================
    // Page State Management
    // ============================================

    const pageState = {
        currentView: 'analytics',
        isFullscreen: false,
        selectedTimeframe: '24h'
    };

    // Expose for debugging
    window.analyticsDebug = {
        pageState,
        showNotification,
        reinitialize: initializeAnalyticsPage
    };

    console.log('[Analytics] Page initialized successfully');
})();
