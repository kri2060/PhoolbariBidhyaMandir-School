/**
 * Lazy load Lottie animations
 * Only loads when element is in viewport
 * Shows fallback emojis on mobile for better performance
 */

(function () {
    'use strict';

    // Detect mobile devices
    const isMobile = window.innerWidth < 768 || /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

    // Load Lottie player script
    function loadLottieScript() {
        if (document.querySelector('script[src*="lottie-player"]')) {
            return Promise.resolve();
        }

        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js';
            script.async = true;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }

    // Show fallback icon
    function showFallback(lottieEl) {
        lottieEl.style.display = 'none';
        const wrapper = lottieEl.closest('.lottie-wrapper');
        if (wrapper) {
            const fallback = wrapper.querySelector('.lottie-fallback');
            if (fallback) {
                fallback.style.display = 'block';
            }
        }
    }

    // Observer for lazy loading
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const lottieEl = entry.target;

                // On mobile, show fallback immediately instead of loading animation
                if (isMobile) {
                    showFallback(lottieEl);
                    observer.unobserve(lottieEl);
                    return;
                }

                // Load Lottie script on desktop
                loadLottieScript().then(() => {
                    // Trigger animation
                    if (lottieEl.play) {
                        lottieEl.play();
                    }
                }).catch(err => {
                    console.warn('Failed to load Lottie player:', err);
                    showFallback(lottieEl);
                });

                observer.unobserve(lottieEl);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });

    // Observe all lottie-player elements
    function initLottie() {
        const lotties = document.querySelectorAll('lottie-player');

        lotties.forEach(lottie => {
            // If mobile, show fallback immediately without observing
            if (isMobile) {
                showFallback(lottie);
            } else {
                lottie.setAttribute('mode', 'normal');
                observer.observe(lottie);
            }
        });
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLottie);
    } else {
        initLottie();
    }
})();
