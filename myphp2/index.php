<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
            text-align: center;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
        nav {
            background-color: #333;
            padding: 10px;
            margin-bottom: 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            margin: 0 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        .student-image {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            display: block;
        }
        .logout-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <h1 class="text-center bg-light p-3 rounded">Student Management System</h1>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="register.php">Register New Student</a></li>
            <li class="nav-item"><a class="nav-link" href="view_students.php">View Students</a></li>
        </ul>
    </nav>
    <img src="student.jpg" alt="Student" class="img-fluid mx-auto d-block">
    
    <form action="logout.php" method="post" class="fixed-bottom m-3">
        <button type="submit" class="btn btn-danger">
            Logout
        </button>
    </form>
</body>
</html>




