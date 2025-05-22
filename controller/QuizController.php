<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/QuizModel.php';

class QuizController {
    private $quizModel;

    public function __construct() {
        $this->quizModel = new QuizModel();
    }

    public function startQuiz($quizId, $userId) {
        // Get randomized question set
        return $this->quizModel->getRandomizedQuestions($quizId);
    }

    public function submitQuiz($postData) {
        return $this->quizModel->saveQuizResult($postData);
    }
}