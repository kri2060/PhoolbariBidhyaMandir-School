/**
 * Sidebar Navigation JavaScript
 * Handles sidebar menu open/close functionality
 */

(function () {
    'use strict';

    // Wait for DOM to be fully loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSidebar);
    } else {
        initSidebar();
    }

    function initSidebar() {
        const hamburger = document.querySelector('.hamburger-menu');
        const sidebar = document.querySelector('.sidebar-nav');
        const backdrop = document.querySelector('.sidebar-backdrop');
        const body = document.body;

        if (!hamburger || !sidebar || !backdrop) {
            console.warn('Sidebar elements not found');
            return;
        }

        // Open sidebar
        function openSidebar() {
            sidebar.classList.add('active');
            backdrop.classList.add('active');
            hamburger.classList.add('active');
            body.classList.add('sidebar-open');
        }

        // Close sidebar
        function closeSidebar() {
            sidebar.classList.remove('active');
            backdrop.classList.remove('active');
            hamburger.classList.remove('active');
            body.classList.remove('sidebar-open');
        }

        // Toggle sidebar
        function toggleSidebar() {
            if (sidebar.classList.contains('active')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }

        // Event listeners
        hamburger.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', closeSidebar);

        // Close sidebar when clicking a link (for better UX)
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Small delay for visual feedback before closing
                setTimeout(closeSidebar, 200);
            });
        });

        // Close sidebar on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });

        // Prevent scroll on sidebar when scrolling inside
        sidebar.addEventListener('wheel', (e) => {
            const scrollTop = sidebar.scrollTop;
            const scrollHeight = sidebar.scrollHeight;
            const height = sidebar.clientHeight;
            const delta = e.deltaY;

            const isAtTop = scrollTop === 0;
            const isAtBottom = scrollTop + height >= scrollHeight;

            if ((isAtTop && delta < 0) || (isAtBottom && delta > 0)) {
                e.preventDefault();
            }
        }, { passive: false });
    }
})();
