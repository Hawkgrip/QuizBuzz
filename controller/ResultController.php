<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/ResultModel.php';

class ResultController {
    private $resultModel;

    public function __construct() {
        $this->resultModel = new ResultModel();
    }

    // Get result history for logged-in student
    public function showResultHistory($userId) {
        return $this->resultModel->getResultsByUser($userId);
    }

    // Export result as CSV or PDF (stub for now)
    public function exportResult($userId, $format = 'csv') {
        $results = $this->resultModel->getResultsByUser($userId);

        if ($format === 'csv') {
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=result_history.csv");

            $output = fopen("php://output", "w");
            fputcsv($output, ['Quiz Title', 'Score', 'Date']);

            foreach ($results as $row) {
                fputcsv($output, [$row['quiz_title'], $row['score'], $row['taken_at']]);
            }

            fclose($output);
            exit;
        }

        // Optional: PDF export using library like FPDF
    }
}
