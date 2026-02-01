/**
 * Simple image slider with fade transitions
 * For campus highlights from CMS gallery
 */

(function () {
    'use strict';

    class FadeSlider {
        constructor(container) {
            this.container = container;
            this.slides = container.querySelectorAll('.slide');
            this.currentIndex = 0;
            this.interval = null;
            this.autoplayDelay = 4000;
            this.touchStartX = 0;
            this.touchEndX = 0;

            if (this.slides.length <= 1) return;

            this.init();
        }

        init() {
            // Set first slide as active
            this.slides[0].classList.add('active');

            // Create dots navigation
            this.createDots();

            // Start autoplay
            this.startAutoplay();

            // Pause on hover
            this.container.addEventListener('mouseenter', () => this.stopAutoplay());
            this.container.addEventListener('mouseleave', () => this.startAutoplay());

            // Touch/swipe support
            this.container.addEventListener('touchstart', (e) => this.handleTouchStart(e), { passive: true });
            this.container.addEventListener('touchend', (e) => this.handleTouchEnd(e), { passive: true });
        }

        createDots() {
            const dotsContainer = document.createElement('div');
            dotsContainer.className = 'slider-dots';

            this.slides.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.className = index === 0 ? 'dot active' : 'dot';
                dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
                dot.addEventListener('click', () => this.goToSlide(index));
                dotsContainer.appendChild(dot);
            });

            this.container.appendChild(dotsContainer);
            this.dots = dotsContainer.querySelectorAll('.dot');
        }

        goToSlide(index) {
            // Remove active class from current
            this.slides[this.currentIndex].classList.remove('active');
            this.dots[this.currentIndex].classList.remove('active');

            // Set new index
            this.currentIndex = index;

            // Add active class to new
            this.slides[this.currentIndex].classList.add('active');
            this.dots[this.currentIndex].classList.add('active');
        }

        nextSlide() {
            const nextIndex = (this.currentIndex + 1) % this.slides.length;
            this.goToSlide(nextIndex);
        }

        previousSlide() {
            const prevIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
            this.goToSlide(prevIndex);
        }

        handleTouchStart(e) {
            this.touchStartX = e.changedTouches[0].screenX;
        }

        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
        }

        handleSwipe() {
            const swipeThreshold = 50; // minimum swipe distance in pixels
            const diff = this.touchStartX - this.touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swiped left - show next
                    this.nextSlide();
                } else {
                    // Swiped right - show previous
                    this.previousSlide();
                }
            }
        }

        startAutoplay() {
            this.interval = setInterval(() => this.nextSlide(), this.autoplayDelay);
        }

        stopAutoplay() {
            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
        }
    }

    // Initialize all sliders
    function initSliders() {
        const sliders = document.querySelectorAll('.fade-slider');
        sliders.forEach(slider => new FadeSlider(slider));
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSliders);
    } else {
        initSliders();
    }
})();
