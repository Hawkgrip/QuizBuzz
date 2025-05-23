<?php
require_once __DIR__ . '/../config/db.php';

class QuestionModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function addQuestion($data) {
        $query = "INSERT INTO questions (question_text, type, difficulty, options_json, correct_answer, created_by, created_at)
                  VALUES (:question_text, :type, :difficulty, :options_json, :correct_answer, :created_by, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_text', $data['question_text']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':difficulty', $data['difficulty']);
        $stmt->bindParam(':options_json', $data['options_json']);
        $stmt->bindParam(':correct_answer', $data['correct_answer']);
        $stmt->bindParam(':created_by', $data['created_by']);

        return $stmt->execute();
    }

    public function getQuestions($filter = [], $limit = 20, $offset = 0) {
        $query = "SELECT * FROM questions WHERE 1=1";
        $params = [];

        if (!empty($filter['type'])) {
            $query .= " AND type = :type";
            $params['type'] = $filter['type'];
        }

        if (!empty($filter['difficulty'])) {
            $query .= " AND difficulty = :difficulty";
            $params['difficulty'] = $filter['difficulty'];
        }

        $query .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);

        // Bind integer parameters separately
        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function importQuestionsFromCSV($filePath) {
        $handle = fopen($filePath, 'r');
        if ($handle === false) return false;

        $db = $this->conn;
        $db->beginTransaction();

        $header = fgetcsv($handle);

        $query = "INSERT INTO questions (question_text, type, difficulty, options_json, correct_answer, created_by, created_at)
                  VALUES (:question_text, :type, :difficulty, :options_json, :correct_answer, :created_by, NOW())";

        $stmt = $db->prepare($query);

        try {
            while (($row = fgetcsv($handle)) !== false) {
                list($question_text, $type, $difficulty, $options_json, $correct_answer, $created_by) = $row;

                $stmt->bindParam(':question_text', $question_text);
                $stmt->bindParam(':type', $type);
                $stmt->bindParam(':difficulty', $difficulty);
                $stmt->bindParam(':options_json', $options_json);
                $stmt->bindParam(':correct_answer', $correct_answer);
                $stmt->bindParam(':created_by', $created_by);

                $stmt->execute();
            }
            $db->commit();
        } catch (PDOException $e) {
            $db->rollBack();
            fclose($handle);
            return false;
        }

        fclose($handle);
        return true;
    }
}
