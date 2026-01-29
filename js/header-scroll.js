/**
 * Transparent Header Effect
 * Makes header transparent at top, solid on scroll
 */

(function () {
    'use strict';

    const header = document.querySelector('header');
    if (!header) return;

    let ticking = false;
    const scrollThreshold = 60; // Trigger transition at 60px scroll

    function updateHeader() {
        const scrolled = window.pageYOffset;

        if (scrolled > scrollThreshold) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        ticking = false;
    }

    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }

    // Initial check
    updateHeader();

    // Listen for scroll
    window.addEventListener('scroll', onScroll, { passive: true });
})();
