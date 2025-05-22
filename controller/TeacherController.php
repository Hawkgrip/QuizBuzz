<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/QuestionModel.php';

class TeacherController {
    private $questionModel;

    public function __construct() {
        $this->questionModel = new QuestionModel();
    }

    public function uploadQuestions($filePath) {
        return $this->questionModel->importQuestionsFromCSV($filePath);
    }

    public function createQuestion($data) {
        return $this->questionModel->addQuestion($data);
    }

    public function getAllQuestions($filter = []) {
        return $this->questionModel->getQuestions($filter);
    }
}
