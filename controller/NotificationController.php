<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/NotificationModel.php';

class NotificationController {
    private $notificationModel;

    public function __construct() {
        $this->notificationModel = new NotificationModel();
    }

    public function getUserNotifications($userId) {
        return $this->notificationModel->getNotifications($userId);
    }

    public function markAsRead($notificationId) {
        return $this->notificationModel->markAsRead($notificationId);
    }
}
