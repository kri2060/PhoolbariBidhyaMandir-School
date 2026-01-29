<?php
$pageTitle = 'Downloads';
$metaDescription = 'Download forms, circulars, and important documents from Phoolbari School';
include __DIR__ . '/../includes/header.php';

// Get category filter
$category = $_GET['category'] ?? 'all';

// Fetch downloads
$query = "SELECT * FROM downloads WHERE is_active = 1";
$params = [];

if ($category !== 'all') {
    $query .= " AND category = ?";
    $params[] = $category;
}

$query .= " ORDER BY created_at DESC";
$downloads = dbSelect($query, $params);

// Get all categories
$categories = dbSelect("SELECT DISTINCT category FROM downloads WHERE is_active = 1 ORDER BY category");

// Track download
if (isset($_GET['download']) && is_numeric($_GET['download'])) {
    $downloadId = (int)$_GET['download'];
    $file = dbSelect("SELECT * FROM downloads WHERE id = ? AND is_active = 1", [$downloadId]);
    
    if (!empty($file)) {
        $filePath = UPLOAD_DIR . $file[0]['file_path'];
        
        if (file_exists($filePath)) {
            // Increment download count
            dbExecute("UPDATE downloads SET download_count = download_count + 1 WHERE id = ?", [$downloadId]);
            
            // Force download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file[0]['file_path']) . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        }
    }
}
?>

<main>
    <div class="container">
        <section>
            <h1>Download Center</h1>
            
            <!-- Category Filter -->
            <?php if (!empty($categories)): ?>
            <div class="card" style="margin-bottom: 2rem;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="<?= SITE_URL ?>/downloads.php" 
                       class="btn <?= $category === 'all' ? 'btn-primary' : '' ?>">All</a>
                    <?php foreach ($categories as $cat): ?>
                    <a href="<?= SITE_URL ?>/downloads.php?category=<?= urlencode($cat['category']) ?>" 
                       class="btn <?= $category === $cat['category'] ? 'btn-primary' : '' ?>">
                        <?= e($cat['category']) ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Downloads List -->
            <?php if (empty($downloads)): ?>
                <div class="card">
                    <p>No downloads available at the moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($downloads as $download): ?>
                <div class="download-item">
                    <div class="download-info">
                        <h4><?= e($download['title']) ?></h4>
                        <?php if ($download['description']): ?>
                        <p style="margin: 0.25rem 0; color: #555;"><?= e($download['description']) ?></p>
                        <?php endif; ?>
                        <p class="download-meta">
                            <?= e($download['file_type']) ?> • 
                            <?= formatFileSize($download['file_size']) ?> • 
                            <?= $download['download_count'] ?> downloads
                        </p>
                    </div>
                    <a href="<?= SITE_URL ?>/downloads.php?download=<?= $download['id'] ?>" 
                       class="btn btn-primary">Download</a>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </section>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
