<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Register</h2>
        <form action="registerUser.php" method="POST" class="mt-3" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required placeholder="e.g. ALI BIN ABU">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="e.g. 12345Abc">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <input type="submit" value="Register" class="btn btn-primary">
        </form>
        
        <a href="login.php" class="mt-3 d-block">Already have an account? Login here.</a>
    </div>
</body>
</html>

<?php
    include "db.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Check if passwords match
        // Removed since it's now handled by JavaScript

        $sql = "INSERT INTO users_reg(username,password) VALUES ('$username','$password')";
        if(mysqli_query($conn,$sql)){
            // Redirect to view_student.php after successful registration
            header("Location: view_student.php");
            exit(); // Ensure no further code is executed
        } else {
            echo "Error: ",$sql."<br>".mysqli_error($conn);
        }
    }
?> 