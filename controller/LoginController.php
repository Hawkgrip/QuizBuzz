<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/UserModel.php';

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleLogin($username, $password, $role) {
        if (empty($username) || empty($password) || !in_array($role, ALLOWED_ROLES)) {
            echo "<p style='color:red;'>Invalid login input.</p>";
            return;
        }

        $user = $this->userModel->loginUser($username, $password, $role);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header('Location: ' . BASE_URL . 'view/' . $role . '/dashboard.php');
            exit;
        } else {
            echo "<p style='color:red;'>Invalid username or password.</p>";
        }
    }
}
