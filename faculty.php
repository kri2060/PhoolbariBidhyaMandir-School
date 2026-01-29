<?php
$pageTitle = 'Faculty';
$metaDescription = 'Meet our experienced and dedicated faculty at Phoolbari School';
include __DIR__ . '/../includes/header.php';

// Fetch faculty members
$faculty = dbSelect(
    "SELECT * FROM faculty 
     WHERE is_active = 1 
     ORDER BY display_order, name"
);

// Group by department
$departments = [];
foreach ($faculty as $member) {
    $dept = $member['department'] ?: 'General';
    if (!isset($departments[$dept])) {
        $departments[$dept] = [];
    }
    $departments[$dept][] = $member;
}
?>

<main>
    <div class="container">
        <section>
            <h1>Our Faculty</h1>
            <p class="text-center" style="margin-bottom: 2rem;">
                Our dedicated team of experienced educators is committed to nurturing 
                young minds and helping students achieve their full potential.
            </p>
            
            <?php if (empty($faculty)): ?>
                <div class="card">
                    <p>Faculty information will be updated soon.</p>
                </div>
            <?php else: ?>
                <?php foreach ($departments as $dept => $members): ?>
                <div style="margin-bottom: 3rem;">
                    <h2 class="section-title"><?= e($dept) ?></h2>
                    <div class="grid">
                        <?php foreach ($members as $member): ?>
                        <div class="card faculty-card">
                            <?php if ($member['photo_path']): ?>
                            <img src="<?= UPLOAD_URL . e($member['photo_path']) ?>" 
                                 alt="<?= e($member['name']) ?>"
                                 style="width: 100%; max-width: 200px; height: 250px; object-fit: cover; border-radius: 8px; margin: 0 auto; display: block;"
                                 loading="lazy">
                            <?php else: ?>
                            <div style="width: 100%; max-width: 200px; height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 64px; font-weight: bold; margin: 0 auto;">
                                <?= strtoupper(substr($member['name'], 0, 1)) ?>
                            </div>
                            <?php endif; ?>
                            <h4><?= e($member['name']) ?></h4>
                            <p class="designation"><?= e($member['designation']) ?></p>
                            <?php if ($member['qualification']): ?>
                            <p style="font-size: 0.85rem; color: #7f8c8d;">
                                <?= e($member['qualification']) ?>
                            </p>
                            <?php endif; ?>
                            <?php if ($member['bio']): ?>
                            <p style="margin-top: 0.5rem;"><?= e(truncate($member['bio'], 100)) ?></p>
                            <?php endif; ?>
                            <?php if ($member['email'] || $member['phone']): ?>
                            <div style="margin-top: 1rem; font-size: 0.85rem;">
                                <?php if ($member['email']): ?>
                                <p>📧 <?= e($member['email']) ?></p>
                                <?php endif; ?>
                                <?php if ($member['phone']): ?>
                                <p>📞 <?= e($member['phone']) ?></p>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </section>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
