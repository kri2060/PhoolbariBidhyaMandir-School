/**
 * Scroll-triggered animations for modern homepage
 * Uses Intersection Observer for performance
 */

(function () {
    'use strict';

    // Animation configuration
    const config = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    // Create observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const delay = entry.target.dataset.delay || 0;

                setTimeout(() => {
                    entry.target.classList.add('animated');
                }, delay);

                // Unobserve after animating (one-time animation)
                observer.unobserve(entry.target);
            }
        });
    }, config);

    // Observe all elements with data-animate attribute
    function initAnimations() {
        const elements = document.querySelectorAll('[data-animate]');
        elements.forEach(el => observer.observe(el));
    }

    // Animate hero elements on page load
    function animateHero() {
        const heroElements = document.querySelectorAll('.animate-on-load');
        heroElements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('animated');
            }, 200 + (index * 150)); // Staggered delays
        });
    }

    // Simple parallax effect for hero
    function initParallax() {
        const hero = document.querySelector('.hero-modern');
        if (!hero) return;

        // Only on desktop and if user hasn't disabled motion
        if (window.innerWidth < 768 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            return;
        }

        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrolled = window.pageYOffset;
                    const parallaxAmount = scrolled * 0.5;
                    hero.style.transform = `translateY(${parallaxAmount}px)`;
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            animateHero();
            initAnimations();
            initParallax();
        });
    } else {
        animateHero();
        initAnimations();
        initParallax();
    }
})();
