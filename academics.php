<?php
$pageTitle = 'Academics';
$metaDescription = 'Academic programs and curriculum at Phoolbari School';
include __DIR__ . '/../includes/header.php';
?>

<main>
    <div class="container">
        <section>
            <h1>Academics</h1>
            
            <div class="card">
                <h2>Our Curriculum</h2>
                <p>
                    At <?= e(SITE_NAME) ?>, we follow a comprehensive curriculum designed to 
                    provide students with a strong foundation in academics while fostering 
                    creativity, critical thinking, and practical skills.
                </p>
            </div>
            
            <div class="card">
                <h2>Classes Offered</h2>
                <div class="grid">
                    <div>
                        <h4>Primary Section</h4>
                        <p>Classes I to V</p>
                        <ul>
                            <li>English</li>
                            <li>Mathematics</li>
                            <li>Science</li>
                            <li>Social Studies</li>
                            <li>Environmental Studies</li>
                            <li>Languages (Regional)</li>
                        </ul>
                    </div>
                    <div>
                        <h4>Middle Section</h4>
                        <p>Classes VI to VIII</p>
                        <ul>
                            <li>English</li>
                            <li>Mathematics</li>
                            <li>Science</li>
                            <li>Social Science</li>
                            <li>Computer Science</li>
                            <li>Languages</li>
                        </ul>
                    </div>
                    <div>
                        <h4>Secondary Section</h4>
                        <p>Classes IX to X</p>
                        <ul>
                            <li>English</li>
                            <li>Mathematics</li>
                            <li>Science</li>
                            <li>Social Science</li>
                            <li>Computer Applications</li>
                            <li>Additional Languages</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <h2>Teaching Methodology</h2>
                <p>We employ innovative teaching methods that include:</p>
                <ul>
                    <li>Interactive classroom sessions</li>
                    <li>Practical demonstrations and experiments</li>
                    <li>Project-based learning</li>
                    <li>Audio-visual aids for better understanding</li>
                    <li>Regular assessments and feedback</li>
                    <li>Remedial classes for individual attention</li>
                </ul>
            </div>
            
            <div class="card">
                <h2>Co-curricular Activities</h2>
                <p>Beyond academics, we offer various activities to develop well-rounded individuals:</p>
                <div class="grid">
                    <div>
                        <h4>Sports</h4>
                        <p>Football, Cricket, Badminton, Athletics, Indoor Games</p>
                    </div>
                    <div>
                        <h4>Arts & Culture</h4>
                        <p>Music, Dance, Drama, Painting, Craft</p>
                    </div>
                    <div>
                        <h4>Clubs & Societies</h4>
                        <p>Science Club, Literary Society, Environment Club, Quiz Club</p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <h2>Assessment & Evaluation</h2>
                <p>
                    We follow a continuous and comprehensive evaluation system that assesses 
                    students on both scholastic and co-scholastic parameters. Regular tests, 
                    assignments, projects, and term examinations ensure thorough evaluation 
                    and timely feedback.
                </p>
            </div>
            
        </section>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
