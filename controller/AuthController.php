<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login($postData) {
        $username = trim($postData['username'] ?? '');
        $password = $postData['password'] ?? '';
        $role = $postData['role'] ?? '';

        if (empty($username) || empty($password) || !in_array($role, ALLOWED_ROLES)) {
            $this->redirectWithError("Invalid input");
        }

        $user = $this->userModel->loginUser($username, $password, $role);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header('Location: ' . BASE_URL . 'view/' . $role . '/dashboard.php');
            exit;
        } else {
            $this->redirectWithError("Incorrect username or password.");
        }
    }

    public function register($postData) {
        if ($this->userModel->registerUser($postData)) {
            header('Location: ' . BASE_URL . 'view/auth/login.php?registered=1');
            exit;
        } else {
            $this->redirectWithError("Registration failed.");
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . 'view/auth/login.php');
        exit;
    }

    private function redirectWithError($msg) {
        $_SESSION['error'] = $msg;
        header('Location: ' . BASE_URL . 'view/auth/login.php');
        exit;
    }
}
