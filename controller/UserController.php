<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function viewProfile() {
        $userId = $_SESSION['user_id'];
        return $this->userModel->getUserById($userId);
    }

    public function updateProfile($postData) {
        $userId = $_SESSION['user_id'];
        return $this->userModel->updateUserProfile($userId, $postData);
    }

    public function changePassword($old, $new) {
        $userId = $_SESSION['user_id'];
        return $this->userModel->changePassword($userId, $old, $new);
    }
}
