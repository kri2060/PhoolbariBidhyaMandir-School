<?php
$pageTitle = 'Gallery';
$metaDescription = 'View our photo gallery showcasing events, campus life, and student activities at Phoolbari School.';
include __DIR__ . '/../includes/header.php';

// Get category from URL
$currentCategory = isset($_GET['category']) ? trim($_GET['category']) : null;

// Logic to fetch data
$albums = [];
$photos = [];

if ($currentCategory) {
    // === PHOTO GRID MODE ===
    // Verify category exists and get photos
    $photos = dbSelect(
        "SELECT * FROM gallery WHERE category = ? AND is_active = 1 ORDER BY id DESC",
        [$currentCategory]
    );
    
    // If no photos found, redirect or show error (optional, handling via empty state below)
    $pageTitle = ucfirst($currentCategory) . ' - Gallery';
} else {
    // === ALBUM LIST MODE ===
    // Get distinct categories
    $categories = dbSelect("SELECT DISTINCT category FROM gallery WHERE is_active = 1 ORDER BY category ASC");
    
    foreach ($categories as $cat) {
        $catName = $cat['category'];
        
        // Get one representative image for the cover (latest one)
        $coverImage = dbSelect(
            "SELECT image_path FROM gallery WHERE category = ? AND is_active = 1 ORDER BY id DESC LIMIT 1",
            [$catName]
        );
        
        // Count photos in this category
        $countResult = dbSelect(
            "SELECT COUNT(*) as total FROM gallery WHERE category = ? AND is_active = 1",
            [$catName]
        );
        
        $albums[] = [
            'name' => $catName,
            'cover' => !empty($coverImage) ? UPLOAD_URL . $coverImage[0]['image_path'] : SITE_URL . '/images/placeholder.jpg',
            'count' => $countResult[0]['total'] ?? 0
        ];
    }
}
?>

<!-- Gallery CSS -->
<link rel="stylesheet" href="<?= SITE_URL ?>/css/gallery.css">

<main>
    <div class="container">
        
        <!-- Gallery Header -->
        <div class="gallery-header">
            <?php if ($currentCategory): ?>
                <div class="gallery-breadcrumb">
                    <a href="<?= SITE_URL ?>/gallery.php">Gallery</a> / <span><?= e(ucfirst($currentCategory)) ?></span>
                </div>
                <h1 class="gallery-title"><?= e(ucfirst($currentCategory)) ?></h1>
            <?php else: ?>
                <h1 class="gallery-title">Photo Gallery</h1>
                <p class="section-subtitle">Moments captured at Phoolbari School</p>
            <?php endif; ?>
        </div>

        <div class="gallery-grid">
            
            <?php if ($currentCategory): ?>
                <!-- PHOTOS VIEW -->
                <?php if (!empty($photos)): ?>
                    <?php foreach ($photos as $photo): ?>
                         <div class="photo-card" onclick="openLightbox('<?= UPLOAD_URL . e($photo['image_path']) ?>', '<?= str_replace(["'", '"'], "", $photo['title']) ?>')">
                            <img src="<?= UPLOAD_URL . e($photo['image_path']) ?>" 
                                 alt="<?= e($photo['title']) ?>" 
                                 loading="lazy">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="gallery-empty">
                        <i class="fas fa-images"></i>
                        <p>No photos found in this album.</p>
                        <a href="<?= SITE_URL ?>/gallery.php" class="btn-secondary-modern">Back to Albums</a>
                    </div>
                <?php endif; ?>
                
            <?php else: ?>
                <!-- ALBUMS VIEW -->
                <?php if (!empty($albums)): ?>
                    <?php foreach ($albums as $album): ?>
                        <a href="?category=<?= urlencode($album['name']) ?>" class="album-card">
                            <div class="album-cover">
                                <img src="<?= $album['cover'] ?>" alt="<?= e($album['name']) ?>" loading="lazy">
                                <div class="album-overlay">
                                    <span style="color:white; font-weight:600;">View Album</span>
                                </div>
                            </div>
                            <div class="album-info">
                                <h3 class="album-title"><?= e($album['name']) ?></h3>
                                <span class="album-count"><?= $album['count'] ?> Photos</span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="gallery-empty">
                        <i class="fas fa-folder-open"></i>
                        <p>No gallery albums available yet.</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
        </div>
        
    </div>
</main>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox">
    <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    <button class="lightbox-prev" onclick="changeImage(-1)"><i class="fas fa-chevron-left"></i></button>
    <button class="lightbox-next" onclick="changeImage(1)"><i class="fas fa-chevron-right"></i></button>
    
    <div class="lightbox-content">
        <img id="lightbox-img" src="" alt="Full view">
    </div>
</div>

<script>
// Simple Lightbox Logic
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const photos = <?= json_encode($currentCategory ? array_map(function($p) { return $p['image_path']; }, $photos) : []) ?>;
const uploadUrl = '<?= UPLOAD_URL ?>';
let currentIndex = 0;

function openLightbox(src, alt) {
    if (!src) return;
    
    // Find index of current image
    // Comparing full src with constructed URL
    currentIndex = photos.findIndex(path => (uploadUrl + path) === src);
    
    if (currentIndex === -1) currentIndex = 0; // Fallback
    
    lightboxImg.src = src;
    lightboxImg.alt = alt;
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    lightbox.classList.remove('active');
    document.body.style.overflow = '';
}

function changeImage(direction) {
    if (photos.length === 0) return;
    
    currentIndex = (currentIndex + direction + photos.length) % photos.length;
    const nextPhoto = photos[currentIndex];
    lightboxImg.src = uploadUrl + nextPhoto;
}

// Close on outside click
lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) closeLightbox();
});

// Keyboard navigation
document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('active')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') changeImage(-1);
    if (e.key === 'ArrowRight') changeImage(1);
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
