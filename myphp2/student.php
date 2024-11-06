<?php
class Student {
    private $conn;

    // Constructor: Initialize database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // CRUD Operations:

    // Create: Register a new student
    public function register($name, $email, $phone) {
        $sql = "INSERT INTO students (name, email, phone) VALUES (?, ?, ?)";
        return $this->executeQuery($sql, [$name, $email, $phone]);
    }

    // Read: Get all students
    public function getAllStudents() {
        $sql = "SELECT * FROM students";
        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    // Read: Get a specific student by ID
    public function getStudentById($id) {
        $sql = "SELECT * FROM students WHERE id = ?";
        return $this->executeQuery($sql, [$id])->fetch_assoc();
    }

    // Update: Modify student information
    public function update($id, $name, $email, $phone) {
        $sql = "UPDATE students SET name = ?, email = ?, phone = ? WHERE id = ?";
        return $this->executeQuery($sql, [$name, $email, $phone, $id]);
    }

    // Delete: Remove a student
    public function delete($id) {
        $sql = "DELETE FROM students WHERE id = ?";
        return $this->executeQuery($sql, [$id]);
    }

    // Helper method to execute prepared statements
    private function executeQuery($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result() ?? $stmt;
    }
}
