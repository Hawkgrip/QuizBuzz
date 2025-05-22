<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = "localhost";
    private $db_name = "quizbuzz_db";
    private $username = "root";      // XAMPP default
    private $password = "";          // XAMPP default blank password

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                                  $this->username,
                                  $this->password,
                                  [
                                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                  ]);
        } catch(PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getConnection() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
