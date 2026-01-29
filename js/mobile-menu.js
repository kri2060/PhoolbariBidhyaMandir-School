/**
 * Mobile Menu Toggle
 * Handles hamburger menu functionality for mobile navigation
 */

(function () {
    'use strict';

    class MobileMenu {
        constructor() {
            this.menuButton = null;
            this.nav = null;
            this.overlay = null;
            this.isOpen = false;

            this.init();
        }

        init() {
            // Wait for DOM to be ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => this.setup());
            } else {
                this.setup();
            }
        }

        setup() {
            this.menuButton = document.querySelector('.mobile-menu-toggle');
            this.nav = document.querySelector('header nav');

            if (!this.menuButton || !this.nav) return;

            // Create overlay
            this.createOverlay();

            // Event listeners
            this.menuButton.addEventListener('click', () => this.toggle());
            this.overlay.addEventListener('click', () => this.close());

            // Close menu when clicking nav links (for smooth navigation)
            const navLinks = this.nav.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', () => this.close());
            });

            // Close on ESC key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.close();
                }
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768 && this.isOpen) {
                    this.close();
                }
            });
        }

        createOverlay() {
            this.overlay = document.createElement('div');
            this.overlay.className = 'mobile-menu-overlay';
            document.body.appendChild(this.overlay);
        }

        toggle() {
            if (this.isOpen) {
                this.close();
            } else {
                this.open();
            }
        }

        open() {
            this.isOpen = true;
            this.menuButton.classList.add('active');
            this.nav.classList.add('mobile-open');
            this.overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scroll
        }

        close() {
            this.isOpen = false;
            this.menuButton.classList.remove('active');
            this.nav.classList.remove('mobile-open');
            this.overlay.classList.remove('active');
            document.body.style.overflow = ''; // Restore scroll
        }
    }

    // Initialize
    new MobileMenu();
})();
