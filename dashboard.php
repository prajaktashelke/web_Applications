<?php
include 'auth_check.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>You are logged in to your dashboard.</p>
        <a href="forgot_password.php" class="link">Forgot Password?</a><br>
        <a href="logout.php" class="link">Logout</a>
    </div>
</body>
</html>
