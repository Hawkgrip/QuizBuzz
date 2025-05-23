<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/UserModel.php';

class SigninController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleSignin($postData) {
        $username = trim($postData['username']);
        $email = trim($postData['email']);
        $password = $postData['password'];
        $role = $postData['role'];

        // Validate inputs (ideally move to validation helper)
        if (empty($username) || empty($email) || empty($password) || !in_array($role, ALLOWED_ROLES)) {
            echo "<p style='color:red;'>Please fill in all fields correctly.</p>";
            return;
        }

        $registered = $this->userModel->registerUser([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ]);

        if ($registered) {
            header("Location: " . BASE_URL . "view/auth/login.php?registered=1");
            exit;
        } else {
            echo "<p style='color:red;'>Registration failed. Try a different username/email.</p>";
        }
    }
}
