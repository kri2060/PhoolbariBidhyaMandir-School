/**
 * Scroll Animation for Mission & Vision Sections
 * Triggers animations when elements scroll into view
 */

document.addEventListener('DOMContentLoaded', function () {
    // Get all elements with scroll animation attributes
    const animatedElements = document.querySelectorAll('[data-scroll-animation]');

    if (animatedElements.length === 0) return;

    // Intersection Observer options
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.2 // Trigger when 20% of element is visible
    };

    // Callback function for intersection observer
    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animation class when element enters viewport
                entry.target.classList.add('animate-in');

                // Optional: Unobserve after animation has been triggered once
                // observer.unobserve(entry.target);
            }
        });
    };

    // Create observer
    const observer = new IntersectionObserver(observerCallback, observerOptions);

    // Observe all animated elements
    animatedElements.forEach(element => {
        observer.observe(element);
    });
});
