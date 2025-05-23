<?php
require_once __DIR__ . '/../config/db.php';

class UserModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function registerUser($data) {
        $query = "INSERT INTO users (role, fname, lname, username, email, password, dob, school)
                  VALUES (:role, :fname, :lname, :username, :email, :password, :dob, :school)";

        $stmt = $this->conn->prepare($query);
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':fname', $data['fname']);
        $stmt->bindParam(':lname', $data['lname']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':dob', $data['dob']);
        $stmt->bindParam(':school', $data['school']);

        return $stmt->execute();
    }

    public function loginUser($username, $password, $role) {
        $query = "SELECT * FROM users WHERE username = :username AND role = :role LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                echo "❌ Password doesn't match.";
            }
        } else {
            echo "❌ No user found with that username and role.";
        }
        return false;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserProfile($id, $data) {
        $query = "UPDATE users SET fname = :fname, lname = :lname, email = :email, dob = :dob, school = :school WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':fname', $data['fname']);
        $stmt->bindParam(':lname', $data['lname']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':dob', $data['dob']);
        $stmt->bindParam(':school', $data['school']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function changePassword($id, $oldPassword, $newPassword) {
        $query = "SELECT password FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($oldPassword, $user['password'])) {
            $hashedNew = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = "UPDATE users SET password = :password WHERE id = :id";
            $stmt2 = $this->conn->prepare($update);
            $stmt2->bindParam(':password', $hashedNew);
            $stmt2->bindParam(':id', $id);
            return $stmt2->execute();
        }
        return false;
    }

    public function getAllUsers() {
        $query = "SELECT id, fname, lname, username, email, role, dob, school FROM users ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserRole($id, $role) {
        $query = "UPDATE users SET role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
