<?php
$pageTitle = 'Home';
$metaDescription = 'Phoolbari School - Providing quality education and nurturing young minds in a modern learning environment';
include __DIR__ . '/../includes/header.php';

// Get hero images from gallery (test1 category) - all for rotation
$heroImages = dbSelect(
    "SELECT image_path FROM gallery 
     WHERE category = 'test1' 
     AND is_active = 1 
     ORDER BY id"
);

// Get campus slider images (test1 category)
$campusImages = dbSelect(
    "SELECT image_path, title FROM gallery 
     WHERE category = 'test1' 
     AND is_active = 1 
     LIMIT 8"
);

// Get notices for ticker
$notices = getActiveNotices(5);
$featuredNews = getFeaturedNewsEvents(3);
?>

<!-- Notice Ticker -->
<?php if (!empty($notices)): ?>
<div class="notice-bar">
    <div class="container">
        <div class="notice-content">
            <?php foreach ($notices as $notice): ?>
                <strong><?= e($notice['title']) ?></strong> - <?= e(truncate($notice['content'], 100)) ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Modern Hero Section -->
<section class="hero-modern" 
         style="background-image: url('<?= !empty($heroImages) ? UPLOAD_URL . $heroImages[0]['image_path'] : '' ?>')"
         data-hero-images='<?= json_encode(array_map(function($img) { return UPLOAD_URL . $img['image_path']; }, $heroImages)) ?>'>
    <div class="hero-overlay"></div>
    <div class="particles-container"></div>
    <div class="hero-content">
        <h1 class="hero-title">Welcome to <?= e(SITE_NAME) ?></h1>
        <p class="hero-subtitle">Empowering minds, shaping futures through excellence in education</p>
        
        <div class="hero-cta">
            <a href="<?= SITE_URL ?>/admissions.php" class="btn-hero-primary">Apply for Admission</a>
            <a href="<?= SITE_URL ?>/about.php" class="btn-hero-secondary">Discover Our Story</a>
        </div>
    </div>
    
    <!-- Carousel Indicators (populated by hero-rotator.js) -->
    <div class="hero-indicators"></div>
    
    <div class="hero-scroll-indicator">
        <span>Scroll to explore</span>
        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14m0 0l-7-7m7 7l7-7"/>
        </svg>
    </div>
</section>

<!-- Main Content -->
<main>
    <div class="container">
        
        <!-- Campus Highlights Slider -->
        <?php if (!empty($campusImages)): ?>
        <section id="campus" class="section-modern campus-section" data-animate="fade-in">
            <h2 class="section-title-modern">Our Vibrant Campus</h2>
            <p class="section-subtitle">Experience the environment where learning comes to life</p>
            
            <div class="fade-slider">
                <?php foreach ($campusImages as $index => $img): ?>
                <div class="slide">
                    <img src="<?= UPLOAD_URL . e($img['image_path']) ?>" 
                         alt="<?= e($img['title']) ?>"
                         loading="lazy">
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- Mission & Vision Sections --><?php
        // Get one image from test1 category for Mission/Vision sections
        $mvImage = dbSelect(
            "SELECT image_path FROM gallery 
             WHERE category = 'test1' 
             AND is_active = 1 
             LIMIT 1"
        );
        $mvImagePath = !empty($mvImage) ? UPLOAD_URL . $mvImage[0]['image_path'] : '';
        ?>
        
        <!-- Our Vision -->
        <section id="vision" class="section-modern mission-vision-section" data-animate="fade-in">
            <div class="mv-container">
                <div class="mv-content" data-scroll-animation="slide-left">
                    <div class="mv-icon">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="28" fill="rgba(212, 175, 55, 0.2)" stroke="#D4AF37" stroke-width="2"/>
                            <path d="M30 15C21.7 15 15 21.7 15 30C15 38.3 21.7 45 30 45C38.3 45 45 38.3 45 30C45 21.7 38.3 15 30 15ZM30 40C24.5 40 20 35.5 20 30C20 24.5 24.5 20 30 20C35.5 20 40 24.5 40 30C40 35.5 35.5 40 30 40ZM30 25C27.2 25 25 27.2 25 30C25 32.8 27.2 35 30 35C32.8 35 35 32.8 35 30C35 27.2 32.8 25 30 25Z" fill="#D4AF37"/>
                        </svg>
                    </div>
                    <h2>Our Vision</h2>
                    <p>We envision <?= e(SITE_NAME) ?> as a dynamic and inspiring educational institution that sets an example for the learning community.</p>
                    <p>We are committed to providing an outstanding learning environment to our students, to enable them to excel and thrive in a complex, constantly changing world, getting more interconnected by the day.</p>
                </div>
                <?php if ($mvImagePath): ?>
                <div class="mv-image-wrapper" data-scroll-animation="slide-right">
                    <div class="blob-shape blob-1">
                        <img src="<?= $mvImagePath ?>" alt="Our Vision" loading="lazy">
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Our Mission -->
        <section id="mission" class="section-modern mission-vision-section reverse" data-animate="fade-in">
            <div class="mv-container">
                <?php if ($mvImagePath): ?>
                <div class="mv-image-wrapper" data-scroll-animation="slide-left">
                    <div class="blob-shape blob-2">
                        <img src="<?= $mvImagePath ?>" alt="Our Mission" loading="lazy">
                    </div>
                </div>
                <?php endif; ?>
                <div class="mv-content" data-scroll-animation="slide-right">
                    <div class="mv-icon">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="28" fill="rgba(139, 21, 56, 0.2)" stroke="#8B1538" stroke-width="2"/>
                            <path d="M30 15L35 25H45L37 32L40 43L30 37L20 43L23 32L15 25H25L30 15Z" fill="#8B1538"/>
                        </svg>
                    </div>
                    <h2>Our Mission</h2>
                    <p>The mission of <?= e(SITE_NAME) ?> is to produce lifelong learners with a value system that turns them into good human beings.</p>
                    <p>Honesty, integrity, and sincerity are values that form the strong foundation on which we build an educational process, culminating in academic and personal success of our students.</p>
                    <p>To this end, we make use of the best educational practices and a rich curriculum. Added to this, we plan on collaborating with all stakeholders including students, parents, families, business houses, civic organizations, higher education institutions and the community at large.</p>
                </div>
            </div>
        </section>
        
    </div><!-- End Main Container temporarily -->

    <!-- Values Section with Lottie -->
    <section id="values" class="section-modern values-section" data-animate="fade-in" data-delay="100">
        <div style="max-width: 1600px; margin: 0 auto; padding: 0 1.5rem;">
            <h2 class="section-title-modern">Our Core Values</h2>
            <p class="section-subtitle">Building character and excellence in every student</p>
            
            <div class="values-grid">
                <div class="value-card" data-animate="slide-up" data-delay="0">
                    <div class="lottie-wrapper">
                        <lottie-player 
                            src="https://assets2.lottiefiles.com/packages/lf20_u4jjb9bd.json"
                            background="transparent"
                            speed="0.8"
                            style="width: 120px; height: 120px;"
                            loop
                            autoplay>
                        </lottie-player>
                        <div class="lottie-fallback" style="display:none;">📚</div>
                    </div>
                    <h3>Academic Excellence</h3>
                    <p>Fostering a love for learning through innovative teaching methods and comprehensive curriculum</p>
                </div>
                
                <div class="value-card" data-animate="slide-up" data-delay="150">
                    <div class="lottie-wrapper">
                        <lottie-player 
                            src="https://assets2.lottiefiles.com/packages/lf20_w51pcehl.json"
                            background="transparent"
                            speed="0.8"
                            style="width: 120px; height: 120px;"
                            loop
                            autoplay>
                        </lottie-player>
                        <div class="lottie-fallback" style="display:none;">⚽</div>
                    </div>
                    <h3>Holistic Development</h3>
                    <p>Nurturing physical fitness, creativity, and personal growth beyond academics</p>
                </div>
                
                <div class="value-card" data-animate="slide-up" data-delay="300">
                    <div class="lottie-wrapper">
                        <lottie-player 
                            src="https://assets10.lottiefiles.com/packages/lf20_w98qte06.json"
                            background="transparent"
                            speed="0.8"
                            style="width: 120px; height: 120px;"
                            loop
                            autoplay>
                        </lottie-player>
                        <div class="lottie-fallback" style="display:none;">💻</div>
                    </div>
                    <h3>Modern Learning</h3>
                    <p>Embracing technology and innovation to prepare students for the future</p>
                </div>
                
                <div class="value-card" data-animate="slide-up" data-delay="450">
                    <div class="lottie-wrapper">
                        <lottie-player 
                            src="https://assets7.lottiefiles.com/packages/lf20_touohxv0.json"
                            background="transparent"
                            speed="0.8"
                            style="width: 120px; height: 120px;"
                            loop
                            autoplay>
                        </lottie-player>
                        <div class="lottie-fallback" style="display:none;">🤝</div>
                    </div>
                    <h3>Community Spirit</h3>
                    <p>Building strong relationships and fostering a supportive learning community</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Container was closed above -->

    <!-- Principal's Message Section (Full Width) -->
    <?php
    $principalImage = dbSelect(
        "SELECT image_path FROM gallery 
            WHERE category = 'eren' 
            AND is_active = 1 
            LIMIT 1"
    );
    $principalImagePath = !empty($principalImage) ? UPLOAD_URL . $principalImage[0]['image_path'] : SITE_URL . '/images/principal-placeholder.jpg';
    ?>
    <section class="principal-message-section">
        <div class="pm-container">
            <div class="pm-content">
                <span class="pm-label">Message from the Principal</span>
                <h2>Message from the Principal</h2>
                <p>When it comes to our sustained efforts aimed at positioning <?= e(SITE_NAME) ?> as an educational institution of repute, we start by asking ourselves some fundamental questions - how can we prepare our students for the disruptions that is set to characterize the 21st Century? What specific competencies do they need to navigate a world that is increasingly complex and interconnected?</p> 
                <p>We believe that the answer lies in a holistic approach to education that balances academic rigor with character development.</p>
                
                <a href="<?= SITE_URL ?>/message-from-principal.php" class="pm-link">
                    Read More <span>→</span>
                </a>
                
                <div class="pm-author">
                    <span class="pm-name">Eren Yeager</span>
                    <span class="pm-title">Principal</span>
                </div>
            </div>
        </div>
        
        <div class="pm-image-wrapper">
            <div class="pm-image-bg">
                <?php if (!empty($principalImage)): ?>
                    <img src="<?= $principalImagePath ?>" alt="Principal" loading="lazy">
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="container"><!-- Re-open Container for subsequent sections -->
    
    <!-- Featured News & Events -->
    <?php if (!empty($featuredNews)): ?>
        <section id="news" class="section-modern" data-animate="fade-in" data-delay="100">
            <h2 class="section-title-modern">Latest News & Events</h2>
            <p class="section-subtitle">Stay connected with what's happening at our school</p>
            
            <div class="news-grid-modern">
                <?php foreach ($featuredNews as $index => $item): ?>
                <div class="news-card-modern" data-animate="slide-up" data-delay="<?= $index * 100 ?>">
                    <?php if ($item['image_path']): ?>
                    <div class="news-image-wrapper">
                        <img src="<?= UPLOAD_URL . e($item['image_path']) ?>" 
                             alt="<?= e($item['title']) ?>" 
                             loading="lazy">
                        <span class="news-badge badge-<?= $item['type'] === 'event' ? 'event' : 'news' ?>">
                            <?= ucfirst(e($item['type'])) ?>
                        </span>
                    </div>
                    <?php endif; ?>
                    <div class="news-content-modern">
                        <h3><?= e($item['title']) ?></h3>
                        <?php if ($item['event_date']): ?>
                        <p class="news-date-modern">
                            📅 <?= formatDate($item['event_date'], 'd M Y, h:i A') ?>
                        </p>
                        <?php endif; ?>
                        <p><?= e(truncate($item['description'], 120)) ?></p>
                        <a href="<?= SITE_URL ?>/news-events.php?id=<?= $item['id'] ?>" class="link-arrow">
                            Read more <span>→</span>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center" style="margin-top: 2rem;">
                <a href="<?= SITE_URL ?>/news-events.php" class="btn-secondary-modern">View All Updates</a>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- Quick Access Cards -->
        <section id="quick-access" class="section-modern" data-animate="fade-in" data-delay="100">
            <h2 class="section-title-modern">Quick Access</h2>
            <p class="section-subtitle">Everything you need, just a click away</p>
            
            <div class="quick-access-grid">
                <a href="<?= SITE_URL ?>/notices.php" class="quick-card" data-animate="slide-up" data-delay="0">
                    <div class="quick-icon">📋</div>
                    <h3>Notices</h3>
                    <p>View important announcements and circulars</p>
                </a>
                
                <a href="<?= SITE_URL ?>/admissions.php" class="quick-card" data-animate="slide-up" data-delay="100">
                    <div class="quick-icon">🎓</div>
                    <h3>Admissions</h3>
                    <p>Learn about our admission process and apply</p>
                </a>
                
                <a href="<?= SITE_URL ?>/faculty.php" class="quick-card" data-animate="slide-up" data-delay="200">
                    <div class="quick-icon">👨‍🏫</div>
                    <h3>Our Faculty</h3>
                    <p>Meet our experienced and dedicated teachers</p>
                </a>
                
                <a href="<?= SITE_URL ?>/downloads.php" class="quick-card" data-animate="slide-up" data-delay="300">
                    <div class="quick-icon">📥</div>
                    <h3>Downloads</h3>
                    <p>Access forms, documents, and resources</p>
                </a>
            </div>
        </section>
        
    </div>
</main>

<!-- Load Scripts -->
<script src="<?= SITE_URL ?>/js/hero-rotator.js"></script>
<script src="<?= SITE_URL ?>/js/hero-blur.js"></script>
<script src="<?= SITE_URL ?>/js/particles-simple.js" defer></script>
<script src="<?= SITE_URL ?>/js/slider.js" defer></script>
<script src="<?= SITE_URL ?>/js/lottie-loader.js" defer></script>
<script src="<?= SITE_URL ?>/js/animations.js" defer></script>
<script src="<?= SITE_URL ?>/js/scroll-animations.js" defer></script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
