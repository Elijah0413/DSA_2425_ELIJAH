<html>
<head>
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<head>
<body>
    <div class="container">
        <h2 class="mt-5">Login</h2>
        <form action="login.php" method="POST" class="mt-3">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required placeholder="e.g. ALI BIN ABU">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="e.g. 12345Abc">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <a href="registerUser.php" class="mt-3 d-block">Don't have an account? Register here</a>
    </div>
</body>
</html>
 
<?php
session_start();
if (file_exists('db.php')) {
    include 'db.php';
} else {
    die('Database connection file not found.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users_reg WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }else{
            echo "invalid username or password";
        }
    }else {
        echo "invalid username or password";
    }
} 