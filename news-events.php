<?php
$pageTitle = 'News & Events';
$metaDescription = 'Latest news and upcoming events at Phoolbari School';
include __DIR__ . '/../includes/header.php';

// Get filter
$filter = $_GET['type'] ?? 'all';

// Fetch news and events
$query = "SELECT * FROM news_events WHERE is_active = 1";
$params = [];

if ($filter === 'news') {
    $query .= " AND type = 'news'";
} elseif ($filter === 'event') {
    $query .= " AND type = 'event'";
}

$query .= " ORDER BY is_featured DESC, created_at DESC";
$items = dbSelect($query, $params);
?>

<main>
    <div class="container">
        <section>
            <h1>News & Events</h1>
            
            <!-- Filter -->
            <div class="card" style="margin-bottom: 2rem;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="<?= SITE_URL ?>/news-events.php" 
                       class="btn <?= $filter === 'all' ? 'btn-primary' : '' ?>">All</a>
                    <a href="<?= SITE_URL ?>/news-events.php?type=news" 
                       class="btn <?= $filter === 'news' ? 'btn-primary' : '' ?>">News</a>
                    <a href="<?= SITE_URL ?>/news-events.php?type=event" 
                       class="btn <?= $filter === 'event' ? 'btn-primary' : '' ?>">Events</a>
                </div>
            </div>
            
            <?php if (empty($items)): ?>
                <div class="card">
                    <p>No <?= $filter === 'all' ? 'items' : $filter ?> found.</p>
                </div>
            <?php else: ?>
                <div class="grid">
                    <?php foreach ($items as $item): ?>
                    <div class="card news-card">
                        <?php if ($item['image_path']): ?>
                        <img src="<?= UPLOAD_URL . e($item['image_path']) ?>" 
                             alt="<?= e($item['title']) ?>" 
                             loading="lazy">
                        <?php endif; ?>
                        <div class="news-content">
                            <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                                <span class="badge badge-<?= $item['type'] === 'event' ? 'high' : 'normal' ?>">
                                    <?= ucfirst(e($item['type'])) ?>
                                </span>
                                <?php if ($item['is_featured']): ?>
                                <span class="badge badge-low">Featured</span>
                                <?php endif; ?>
                            </div>
                            <h3><?= e($item['title']) ?></h3>
                            <?php if ($item['event_date']): ?>
                            <p class="news-date">
                                <strong>Date:</strong> <?= formatDate($item['event_date'], 'd M Y, h:i A') ?>
                            </p>
                            <?php endif; ?>
                            <p><?= nl2br(e($item['description'])) ?></p>
                            <p class="news-date">Posted: <?= formatDate($item['created_at'], 'd M Y') ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
        </section>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
