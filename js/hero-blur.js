/**
 * Progressive Hero Blur on Scroll
 * Blurs the hero section as user scrolls down for better content readability
 */

(function () {
    'use strict';

    const hero = document.querySelector('.hero-modern');
    if (!hero) return;

    let ticking = false;

    function updateHeroBlur() {
        const scrolled = window.pageYOffset;
        const heroHeight = hero.offsetHeight;

        // Calculate blur amount based on scroll (0 to 20px blur)
        // Starts blurring after 200px of scroll
        const blurStart = 200;
        const blurMax = 20; // Maximum blur in pixels

        let blurAmount = 0;

        if (scrolled > blurStart) {
            // Progressive blur: increases with scroll
            const scrollProgress = Math.min((scrolled - blurStart) / 400, 1);
            blurAmount = scrollProgress * blurMax;
        }

        // Apply blur filter to hero background layers
        const bgLayers = hero.querySelectorAll('.hero-bg-layer');
        bgLayers.forEach(layer => {
            layer.style.filter = `blur(${blurAmount}px)`;
        });

        // Also blur the hero content (text) as we scroll
        const heroContent = hero.querySelector('.hero-content');
        if (heroContent) {
            const contentBlur = Math.min(blurAmount * 0.5, 10); // Half the bg blur, max 10px
            heroContent.style.filter = `blur(${contentBlur}px)`;
        }

        // Also reduce opacity slightly as we scroll
        const opacityAmount = Math.max(1 - (scrolled - blurStart) / 800, 0.3);
        bgLayers.forEach(layer => {
            layer.style.opacity = layer.classList.contains('active') ? opacityAmount : 0;
        });

        // Fade out hero content even more
        if (heroContent) {
            const contentOpacity = Math.max(1 - (scrolled - blurStart) / 600, 0);
            heroContent.style.opacity = contentOpacity;
        }

        ticking = false;
    }

    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(updateHeroBlur);
            ticking = true;
        }
    }

    // Initial state
    updateHeroBlur();

    // Listen for scroll
    window.addEventListener('scroll', onScroll, { passive: true });
})();
