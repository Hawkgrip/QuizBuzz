<?php
require_once __DIR__ . '/../config/db.php';

class ResultModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getResultsByUser($userId) {
        $query = "SELECT r.*, q.title AS quiz_title FROM results r
                  JOIN quizzes q ON r.quiz_id = q.id
                  WHERE r.user_id = :user_id
                  ORDER BY r.taken_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPerformanceAnalytics($userId) {
        $query = "SELECT q.title, AVG(r.score) as avg_score FROM results r
                  JOIN quizzes q ON r.quiz_id = q.id
                  WHERE r.user_id = :user_id
                  GROUP BY q.title";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
