<?php
// Start secure session if not already started
function startSecureSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();

        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }
}

// Check if user is logged in
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

// Require login: redirect to login page if not logged in
function requireLogin(string $redirectTo = '/view/auth/login.php') {
    if (!isLoggedIn()) {
        header("Location: $redirectTo");
        exit;
    }
}

// Get logged-in user role
function getUserRole(): ?string {
    return $_SESSION['role'] ?? null;
}

// Check if user has specific role
function isUserRole(string $role): bool {
    return getUserRole() === $role;
}

// Logout user and destroy session
function logoutUser() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}
