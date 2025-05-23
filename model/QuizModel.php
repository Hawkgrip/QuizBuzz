<?php
require_once __DIR__ . '/../config/db.php';

class QuizModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getRandomizedQuestions($quizId) {
        $query = "SELECT q.* FROM questions q
                  INNER JOIN quiz_questions qq ON q.id = qq.question_id
                  WHERE qq.quiz_id = :quizId
                  ORDER BY RAND()";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quizId', $quizId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveQuizResult($data) {
        $query = "INSERT INTO results (user_id, quiz_id, score, taken_at) VALUES (:user_id, :quiz_id, :score, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':quiz_id', $data['quiz_id']);
        $stmt->bindParam(':score', $data['score']);

        return $stmt->execute();
    }
}
