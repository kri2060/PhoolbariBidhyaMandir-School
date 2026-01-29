<?php
$pageTitle = 'Notices & Announcements';
$metaDescription = 'Stay updated with the latest notices and announcements from Phoolbari School';
include __DIR__ . '/../includes/header.php';

// Fetch all active notices
$notices = dbSelect(
    "SELECT * FROM notices 
     WHERE is_active = 1 
     AND publish_date <= NOW() 
     AND (expire_date IS NULL OR expire_date >= NOW())
     ORDER BY priority DESC, publish_date DESC"
);
?>

<main>
    <div class="container">
        <section>
            <h1>Notices & Announcements</h1>
            
            <?php if (empty($notices)): ?>
                <div class="card">
                    <p>No active notices at the moment. Please check back later.</p>
                </div>
            <?php else: ?>
                <?php foreach ($notices as $notice): ?>
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: start; gap: 1rem;">
                        <div style="flex: 1;">
                            <h3><?= e($notice['title']) ?></h3>
                            <p class="news-date">
                                Published: <?= formatDate($notice['publish_date'], 'd M Y') ?>
                                <?php if ($notice['expire_date']): ?>
                                    | Valid till: <?= formatDate($notice['expire_date'], 'd M Y') ?>
                                <?php endif; ?>
                            </p>
                            <p><?= nl2br(e($notice['content'])) ?></p>
                        </div>
                        <span class="badge badge-<?= e($notice['priority']) ?>">
                            <?= ucfirst(e($notice['priority'])) ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </section>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
