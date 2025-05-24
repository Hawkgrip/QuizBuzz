<?php
require_once __DIR__ . '/../config/db.php';

class NotificationModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getNotifications($userId) {
        $query = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markAsRead($notificationId) {
        $query = "UPDATE notifications SET is_read = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $notificationId);
        return $stmt->execute();
    }

    public function addNotification($userId, $message) {
        $query = "INSERT INTO notifications (user_id, message, is_read, created_at)
                  VALUES (:user_id, :message, 0, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':message', $message);

        return $stmt->execute();
    }
}
