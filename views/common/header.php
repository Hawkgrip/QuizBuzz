<?php
// Start the session to check for logged-in users
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizBuzz | Online Quiz Platform</title>

    <!-- Link to CSS files -->
    <link rel="stylesheet" href="/public/css/style.css"> <!-- Main stylesheet -->
    <link rel="stylesheet" href="/public/css/landingpage.css"> <!-- Landing page specific -->

    <!-- Add Bootstrap or other CSS files as needed -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">QuizBuzz</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL . 'view/auth/login.php'; ?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL . 'view/auth/signup.php'; ?>">Sign Up</a>
                </li>
                <?php if (isset($_SESSION['role'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL . 'view/' . $_SESSION['role'] . '/dashboard.php'; ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL . 'controller/AuthController.php?action=logout'; ?>">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
