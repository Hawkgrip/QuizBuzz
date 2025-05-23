<?php
require_once __DIR__ . '/../config/db.php';

class ContactModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function submitForm($data) {
        $query = "INSERT INTO contacts (name, email, message, created_at)
                  VALUES (:name, :email, :message, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':message', $data['message']);

        return $stmt->execute();
    }
}
