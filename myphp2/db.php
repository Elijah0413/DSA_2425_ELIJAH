<?php
// Configuration array for database connection
$config = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'student_management'
];

// Use mysqli_report to throw exceptions on errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection using the config array
    $conn = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);

    // Set character set to utf8mb4
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    // Log the error instead of exposing it directly
    error_log("Database connection failed: " . $e->getMessage());
    die("A database error occurred. Please try again later.");
}

// Function to get database connection
function getConnection() {
    global $conn;
    return $conn;
}

?>
/
