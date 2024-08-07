<?php
session_start();
include 'db.php'; 

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['password'];
    
    if (isset($_SESSION['email'])) {
        $email = $conn->real_escape_string($_SESSION['email']);
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE users_register SET password='$hashedPassword' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            $message = "Password reset successfully. <a href='login.php'>Login here</a>";
            unset($_SESSION['otp']); 
            unset($_SESSION['email']); 
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Session expired or email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Reset Password</h1>
        <form method="post" action="">
            <label for="password">New Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Reset Password">
        </form>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
