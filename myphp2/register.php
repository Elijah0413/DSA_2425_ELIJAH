<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone']);
    
    // Perform validation here
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }
    
    if (empty($errors)) {
        // Save to database or file
        $success = saveUserData($name, $email, $phone);
        
        if ($success) {
            // Set success message
            $message = "<div class='message success'>
                            <p>Registration successful!</p>
                        </div>";
          
        } else {
            $message = "<div class='message error'>
                            <p>Registration failed. Please try again.</p>
                        </div>";
        }
    } else {
        $message = "<div class='message error'><ul>";
        foreach ($errors as $error) {
            $message .= "<li>$error</li>";
        }
        $message .= "</ul></div>";
    }
}

function saveUserData($name, $email, $phone) {
    // Save to CSV file
    $data = array($name, $email, $phone, date('Y-m-d H:i:s'));
    $file = fopen('students.csv', 'a');
    $csv_success = fputcsv($file, $data);
    fclose($file);
    
    // Save to database
    require_once 'db.php';
    $sql = "INSERT INTO students (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $phone);
    $db_success = $stmt->execute();
    $stmt->close();
    
    return $csv_success && $db_success;
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container-fluid">
    <h2 class="text-center text-primary mb-4">STUDENT REGISTRATION</h2>
    <?php if (isset($message)) echo $message; ?>
    <form method="POST" action="register.php" class="p-4 bg-light rounded shadow">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" class="form-control" required>
        </div>

        <input type="submit" value="Register" class="btn btn-success btn-block">
        <div class="d-flex justify-content-between mt-3">
            <p><a href='view_students.php'>View all students</a></p>
            <p><a href='index.php'>Return to homepage</a></p>
        </div>
    </form>
</div>
