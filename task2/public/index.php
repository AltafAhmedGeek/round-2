<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to the Simple Web Application</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="protected_page.php">Protected Page</a><br>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="register.php">Register</a><br>
        <a href="login.php">Login</a><br>
        <a href="forgot_password.php">Forgot Password</a>
    <?php endif; ?>
</body>
</html>
