<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/ResultModel.php';

class StudentController {
    private $resultModel;

    public function __construct() {
        $this->resultModel = new ResultModel();
    }

    public function getResultHistory($userId) {
        return $this->resultModel->getResultsByUser($userId);
    }

    public function getAnalytics($userId) {
        return $this->resultModel->getPerformanceAnalytics($userId);
    }
}