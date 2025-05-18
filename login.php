<?php
session_start();
require_once 'includes/functions.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            if ($user['is_verified']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: dashboard.php');
                exit();
            } else {
                $error = "Account not verified. Please check your email.";
            }
        } else {
            $error = "Invalid username or password";
        }
    } catch (PDOException $e) {
        $error = "Login failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php 
        if (isset($_SESSION['message'])) {
            echo "<p class='success'>".$_SESSION['message']."</p>";
            unset($_SESSION['message']);
        }
        if (isset($error)) echo "<p class='error'>$error</p>"; 
        ?>
        <form method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-options">
                <a href="register.php">Don't have an account? Register</a>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit">Login</button>
            <a href="index.php" class="home-link">Kembali ke Beranda</a>
        </form>
    </div>
</body>
</html>