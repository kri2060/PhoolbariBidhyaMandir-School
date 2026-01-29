<?php
$pageTitle = 'Contact Us';
$metaDescription = 'Get in touch with Phoolbari School';
include __DIR__ . '/../includes/header.php';

// Form submission handling
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $subject = sanitize($_POST['subject'] ?? '');
    $message = sanitize($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address';
    } else {
        // In production, send email or save to database
        // For now, just show success message
        $success = true;
        
        // Optional: Log the inquiry
        error_log("Contact form submission: Name=$name, Email=$email, Subject=$subject");
    }
}
?>

<main>
    <div class="container">
        <section>
            <h1>Contact Us</h1>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    Thank you for contacting us! We will get back to you soon.
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?= e($error) ?></div>
            <?php endif; ?>
            
            <div class="grid">
                <!-- Contact Information -->
                <div class="card">
                    <h2>Get in Touch</h2>
                    <p>
                        <strong><?= e(SITE_NAME) ?></strong><br>
                        <?= e(getSiteSetting('school_address', 'Phoolbari, West Bengal, India')) ?>
                    </p>
                    
                    <p>
                        <strong>Email:</strong><br>
                        <?= e(getSiteSetting('school_email', 'info@phoolbari.edu')) ?>
                    </p>
                    
                    <p>
                        <strong>Phone:</strong><br>
                        <?= e(getSiteSetting('school_phone', '+91-1234567890')) ?>
                    </p>
                    
                    <p>
                        <strong>Office Hours:</strong><br>
                        Monday to Friday: 9:00 AM - 3:00 PM<br>
                        Saturday: 9:00 AM - 12:00 PM<br>
                        Sunday: Closed
                    </p>
                </div>
                
                <!-- Contact Form -->
                <div class="card">
                    <h2>Send Us a Message</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required 
                                   value="<?= e($_POST['name'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required 
                                   value="<?= e($_POST['email'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="<?= e($_POST['phone'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   value="<?= e($_POST['subject'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" 
                                      name="message" 
                                      required 
                                      rows="5"><?= e($_POST['message'] ?? '') ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
            
        </section>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
