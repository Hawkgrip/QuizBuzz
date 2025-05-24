<?php
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
        // Mark the notification as read in the database
        $this->notificationModel->markAsRead($notificationId);
        header('Location: ' . BASE_URL . 'view/notifications.php');
        exit;
    }
}
