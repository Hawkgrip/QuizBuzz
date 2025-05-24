<?php
// Include the header (e.g., for navigation)
include('common/header.php');
?>

<!-- Hero Section -->
<section id="hero" class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Welcome to QuizBuzz!</h1>
        <p class="hero-description">Your go-to platform for online quizzes, exams, and learning.</p>
        <a href="/view/auth/login.php" class="btn btn-primary">Get Started</a>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features-section">
    <div class="container">
        <h2 class="section-title text-center">Our Features</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <h3>Interactive Quizzes</h3>
                    <p>Take quizzes and exams on various subjects, track your progress, and challenge yourself!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h3>Real-Time Results</h3>
                    <p>Get instant results after each quiz and analyze your strengths and weaknesses.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h3>Customizable Questions</h3>
                    <p>Create your own quizzes or choose from a large question bank for a personalized experience.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section id="cta" class="cta-section text-center">
    <div class="container">
        <h2>Ready to test your knowledge?</h2>
        <p>Sign up or log in to start your journey with QuizBuzz!</p>
        <a href="/view/auth/signup.php" class="btn btn-primary">Sign Up</a>
        <a href="/view/auth/login.php" class="btn btn-secondary">Log In</a>
    </div>
</section>

<!-- Footer Section -->
<footer id="footer" class="footer-section text-center">
    <div class="container">
        <p>&copy; 2025 QuizBuzz. All Rights Reserved.</p>
        <ul class="footer-links">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
        </ul>
    </div>
</footer>

<?php
// Include the footer (e.g., for common footer scripts)
include('common/footer.php');
?>
