<?php
$pageTitle = 'Admissions';
$metaDescription = 'Admission information and process at Phoolbari School';
include __DIR__ . '/../includes/header.php';
?>

<main>
    <div class="container">
        <section>
            <h1>Admissions</h1>
            
            <div class="card">
                <h2>Admission Process</h2>
                <p>
                    We welcome students who are eager to learn and grow. Our admission process 
                    is designed to be simple and transparent.
                </p>
            </div>
            
            <div class="card">
                <h2>Admission Criteria</h2>
                <ul>
                    <li>Age-appropriate admission as per government norms</li>
                    <li>Transfer certificate from previous school (if applicable)</li>
                    <li>Birth certificate (original for verification)</li>
                    <li>Address proof</li>
                    <li>Recent passport-size photographs</li>
                    <li>Previous academic records</li>
                </ul>
            </div>
            
            <div class="card">
                <h2>Steps to Apply</h2>
                <div style="margin-top: 1rem;">
                    <h4 style="color: #3498db;">Step 1: Obtain Application Form</h4>
                    <p>Download the admission form from our downloads section or collect from the school office.</p>
                    
                    <h4 style="color: #3498db; margin-top: 1.5rem;">Step 2: Fill the Form</h4>
                    <p>Complete all sections of the application form with accurate information.</p>
                    
                    <h4 style="color: #3498db; margin-top: 1.5rem;">Step 3: Submit Documents</h4>
                    <p>Submit the filled form along with required documents at the school office.</p>
                    
                    <h4 style="color: #3498db; margin-top: 1.5rem;">Step 4: Interaction (if required)</h4>
                    <p>Students may be called for an informal interaction/assessment based on the class.</p>
                    
                    <h4 style="color: #3498db; margin-top: 1.5rem;">Step 5: Admission Confirmation</h4>
                    <p>Upon selection, complete the admission formalities and pay the required fees.</p>
                </div>
            </div>
            
            <div class="card">
                <h2>Important Dates</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Admission Form Availability</td>
                            <td>December - March</td>
                        </tr>
                        <tr>
                            <td>Last Date for Submission</td>
                            <td>March 31st</td>
                        </tr>
                        <tr>
                            <td>Interaction/Assessment</td>
                            <td>April (as scheduled)</td>
                        </tr>
                        <tr>
                            <td>Admission Confirmation</td>
                            <td>April - May</td>
                        </tr>
                        <tr>
                            <td>Session Begins</td>
                            <td>June</td>
                        </tr>
                    </tbody>
                </table>
                <p style="margin-top: 1rem; font-size: 0.9rem; color: #7f8c8d;">
                    <em>Note: Dates are tentative and subject to change. Please check notices for updated information.</em>
                </p>
            </div>
            
            <div class="card">
                <h2>Fee Structure</h2>
                <p>
                    For detailed fee structure, please contact the school office or download 
                    the fee prospectus from the downloads section.
                </p>
                <a href="<?= SITE_URL ?>/downloads.php?category=Forms" class="btn btn-primary">
                    Download Fee Prospectus
                </a>
            </div>
            
            <div class="card">
                <h2>Contact for Admission</h2>
                <p>For any queries regarding admissions, please contact:</p>
                <p>
                    <strong>Email:</strong> <?= e(getSiteSetting('school_email', 'info@phoolbari.edu')) ?><br>
                    <strong>Phone:</strong> <?= e(getSiteSetting('school_phone', '+91-1234567890')) ?><br>
                    <strong>Office Hours:</strong> Monday to Friday, 9:00 AM - 3:00 PM
                </p>
                <a href="<?= SITE_URL ?>/contact.php" class="btn">Contact Us</a>
            </div>
            
        </section>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
