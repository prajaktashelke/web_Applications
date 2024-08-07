<?php
session_start();
include 'db.php'; 

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "SELECT email FROM users_register WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email; 
        $_SESSION['otp'] = '1111';
        $message = "An OTP has been sent to your email.";
        header('Location: verify_otp.php'); 
        exit();
    } else {
        $message = "No account found with this email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Forgot Password</h1>
        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <input type="submit" value="Send OTP">
        </form>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
