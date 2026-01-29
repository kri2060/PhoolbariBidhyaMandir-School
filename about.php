<?php
$pageTitle = 'About Us';
$metaDescription = 'Learn about Phoolbari School - our vision, mission, and commitment to excellence in education';
include __DIR__ . '/../includes/header.php';
?>

<main>
    <div class="container">
        <section>
            <h1>About <?= e(SITE_NAME) ?></h1>
            
            <div class="card">
                <h2>Our Vision</h2>
                <p>
                    To be a leading educational institution that empowers students to become confident, 
                    knowledgeable, and compassionate individuals who contribute positively to society.
                </p>
            </div>
            
            <div class="card">
                <h2>Our Mission</h2>
                <p>
                    Our mission is to provide a nurturing and inclusive learning environment that:
                </p>
                <ul>
                    <li>Fosters academic excellence and critical thinking</li>
                    <li>Promotes moral values and ethical behavior</li>
                    <li>Encourages creativity and innovation</li>
                    <li>Develops physical fitness and sports skills</li>
                    <li>Builds character and leadership qualities</li>
                </ul>
            </div>
            
            <div class="card">
                <h2>Our History</h2>
                <p>
                    Established in [Year], <?= e(SITE_NAME) ?> has been serving the community for 
                    [X] years. What started as a small institution with a handful of students has 
                    grown into a thriving educational center with modern facilities and a dedicated 
                    team of educators.
                </p>
                <p>
                    Over the years, we have consistently maintained high academic standards while 
                    adapting to the changing educational landscape. Our alumni have gone on to 
                    excel in various fields, making us proud of their achievements.
                </p>
            </div>
            
            <div class="card">
                <h2>Infrastructure & Facilities</h2>
                <p>Our school is equipped with:</p>
                <ul>
                    <li>Well-ventilated and spacious classrooms</li>
                    <li>Science and computer laboratories</li>
                    <li>Library with extensive collection of books</li>
                    <li>Sports grounds and indoor games facilities</li>
                    <li>Audio-visual rooms for multimedia learning</li>
                    <li>Safe and hygienic environment</li>
                </ul>
                <a href="<?= SITE_URL ?>/facilities.php" class="btn">View All Facilities</a>
            </div>
            
            <div class="card">
                <h2>Our Values</h2>
                <div class="grid">
                    <div>
                        <h4>Excellence</h4>
                        <p>We strive for excellence in all that we do</p>
                    </div>
                    <div>
                        <h4>Integrity</h4>
                        <p>We uphold honesty and strong moral principles</p>
                    </div>
                    <div>
                        <h4>Respect</h4>
                        <p>We value diversity and treat everyone with dignity</p>
                    </div>
                    <div>
                        <h4>Innovation</h4>
                        <p>We encourage creative thinking and new ideas</p>
                    </div>
                </div>
            </div>
            
        </section>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
