<?php
require_once 'db.php';
require_once 'student.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $student = new Student(getConnection());
    
    if ($student->delete($id)) {
        header("Location: view_students.php?message=Student deleted successfully");
    } else {
        header("Location: view_students.php?message=Error deleting student");
    }
} else {
    header("Location: view_students.php");
}
exit();
