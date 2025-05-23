<?php
require_once __DIR__ . '/../config/db.php';

class ActivityLogModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function logAction($userId, $action) {
        $query = "INSERT INTO activity_logs (user_id, action, timestamp) VALUES (:user_id, :action, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':action', $action);
        return $stmt->execute();
    }

    public function getAllLogs($limit = 100) {
        $query = "SELECT al.*, u.username FROM activity_logs al
                  LEFT JOIN users u ON al.user_id = u.id
                  ORDER BY timestamp DESC LIMIT :limit";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
