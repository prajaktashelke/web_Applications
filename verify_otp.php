<?php
session_start();
include 'db.php'; 

$message = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $otp = $conn->real_escape_string($_POST['otp']);
    
    if ($otp === '1111') {
        if (isset($_SESSION['email'])) {
            $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); 
            $email = $conn->real_escape_string($_SESSION['email']);
            
            $sql = "UPDATE users_register SET password='$newPassword' WHERE email='$email'";
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
    } else {
        $message = "Invalid OTP.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Verify OTP</h1>
        <form method="post" action="">
            <label for="otp">Enter OTP:</label>
            <input type="text" name="otp" required>
            <label for="password">New Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Verify OTP and Reset Password">
        </form>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
