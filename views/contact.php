<?php
// Include header for the common navigation bar
include('common/header.php');
?>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title text-center">Contact Us</h2>

        <?php
        // Display success or error message if form submission fails or succeeds
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-info'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>

        <form id="contactForm" method="POST" action="/controller/ContactController.php?action=submitForm" class="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" class="form-control" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</section>

<?php
// Include footer for common footer content
include('common/footer.php');
?>
