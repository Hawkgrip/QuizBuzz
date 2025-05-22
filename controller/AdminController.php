<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/ActivityLogModel.php';

class AdminController {
    private $userModel;
    private $logModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->logModel = new ActivityLogModel();
    }

    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }

    public function getActivityLogs() {
        return $this->logModel->getAllLogs();
    }

    public function changeUserRole($userId, $newRole) {
        return $this->userModel->updateUserRole($userId, $newRole);
    }
}