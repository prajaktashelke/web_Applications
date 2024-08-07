<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users_register WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) { // Verify the password
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username']; // Store username in session
            header('Location: dashboard.php'); // Redirect to a logged-in page
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No user found with this username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" action="">  
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <input type="submit" name="login" value="Login">
        </form>
        <a href="register.php" class="link">Don't have an account? Register here</a>
        <a href="forgot_password.php" class="link">Forgot Password?</a>
        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
