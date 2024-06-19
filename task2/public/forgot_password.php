<?php
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $otp = "1111";
    if ($otp === $_POST['otp']) {
        $new_password = $_POST['new_password']; // Generate a new password or let the user provide one
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("UPDATE users_table SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            echo "Password reset successful. Use new password: $new_password<br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }

        $stmt->close();
    } else {
        echo "Error: Invalid OTP <br>";
    }
}
$conn->close();
?>

<form method="post" action="">
    Email: <input type="email" name="email" required><br>
    OTP : <input type="text" name="otp" required><br>
    New Password : <input type="text" name="new_password" required><br>
    <input type="submit" value="Reset Password">
</form>