/**
 * Hero Background Image Rotator with Ken Burns Effect
 * - 6 second cycle: 3s zoom-in animation + 3s hold
 * - Manual navigation with prev/next arrows
 * - Carousel indicators for direct navigation
 * - Instant zoom effect on image change
 */

(function () {
    'use strict';

    const hero = document.querySelector('.hero-modern');
    if (!hero) return;

    const imagesData = hero.dataset.heroImages;
    if (!imagesData) return;

    let images;
    try {
        images = JSON.parse(imagesData);
    } catch (e) {
        console.error('Failed to parse hero images:', e);
        return;
    }

    if (!images || images.length <= 1) return;

    // Create background layers for crossfade
    const bgLayer1 = document.createElement('div');
    const bgLayer2 = document.createElement('div');

    bgLayer1.className = 'hero-bg-layer active';
    bgLayer2.className = 'hero-bg-layer';

    bgLayer1.style.backgroundImage = hero.style.backgroundImage;

    hero.style.backgroundImage = 'none';
    hero.insertBefore(bgLayer2, hero.firstChild);
    hero.insertBefore(bgLayer1, hero.firstChild);

    // Create navigation arrows
    const prevBtn = document.createElement('button');
    const nextBtn = document.createElement('button');

    prevBtn.className = 'hero-nav-btn hero-nav-prev';
    prevBtn.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>';
    prevBtn.setAttribute('aria-label', 'Previous image');

    nextBtn.className = 'hero-nav-btn hero-nav-next';
    nextBtn.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>';
    nextBtn.setAttribute('aria-label', 'Next image');

    hero.appendChild(prevBtn);
    hero.appendChild(nextBtn);

    // Create carousel indicators
    const indicatorsContainer = hero.querySelector('.hero-indicators');
    const indicators = [];

    if (indicatorsContainer && images.length > 1) {
        images.forEach((_, index) => {
            const indicator = document.createElement('button');
            indicator.className = 'hero-indicator';
            if (index === 0) indicator.classList.add('active');
            indicator.setAttribute('aria-label', `Go to slide ${index + 1}`);
            indicator.dataset.index = index;
            indicatorsContainer.appendChild(indicator);
            indicators.push(indicator);
        });
    }

    let currentIndex = 0;
    let activeLayer = bgLayer1;
    let inactiveLayer = bgLayer2;
    let autoRotateInterval;

    function startKenBurns(layer) {
        // Remove animation class
        layer.classList.remove('ken-burns');
        // Force reflow to restart animation
        void layer.offsetWidth;
        // Add animation class to start Ken Burns effect
        layer.classList.add('ken-burns');
    }

    function updateIndicators() {
        if (!indicatorsContainer) return;
        indicators.forEach((ind, idx) => {
            ind.classList.toggle('active', idx === currentIndex);
        });
    }

    function goToSlide(index) {
        if (index === currentIndex || index < 0 || index >= images.length) return;

        // Set current index to one before target so rotateBackground goes to correct slide
        currentIndex = (index - 1 + images.length) % images.length;

        rotateBackground('next', true);
        startAutoRotate();
    }

    function rotateBackground(direction = 'next', instant = false) {
        // Update index
        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % images.length;
        } else if (direction === 'prev') {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
        }

        const nextImage = images[currentIndex];

        // Set next image on inactive layer
        inactiveLayer.style.backgroundImage = `url('${nextImage}')`;

        // Start Ken Burns on the new layer BEFORE making it visible
        startKenBurns(inactiveLayer);

        if (instant) {
            // Instant switch for manual navigation
            // DON'T remove ken-burns from old layer - let it stay zoomed while fading
            activeLayer.classList.remove('active');
            inactiveLayer.classList.add('active');
        } else {
            // Smooth crossfade for auto-rotation
            // DON'T remove ken-burns from old layer - let it stay zoomed while fading
            activeLayer.classList.remove('active');
            inactiveLayer.classList.add('active');
        }

        // Update indicators
        updateIndicators();

        // Swap layer references
        [activeLayer, inactiveLayer] = [inactiveLayer, activeLayer];
    }

    function startAutoRotate() {
        stopAutoRotate();
        autoRotateInterval = setInterval(() => rotateBackground('next', false), 6000);
    }

    function stopAutoRotate() {
        if (autoRotateInterval) {
            clearInterval(autoRotateInterval);
        }
    }

    // Navigation button handlers
    prevBtn.addEventListener('click', () => {
        rotateBackground('prev', true);
        startAutoRotate(); // Restart auto-rotation
    });

    nextBtn.addEventListener('click', () => {
        rotateBackground('next', true);
        startAutoRotate(); // Restart auto-rotation
    });

    // Indicator click handlers
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            goToSlide(index);
        });
    });

    // Start Ken Burns on initial layer
    startKenBurns(activeLayer);

    // Start auto-rotation (6 seconds per image)
    startAutoRotate();
})();
