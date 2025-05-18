<?php
session_start();
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $address = sanitize($_POST['address']);
    $phone = sanitize($_POST['phone']);
    $username = sanitize($_POST['username']);
    $password = password_hash(sanitize($_POST['password']), PASSWORD_BCRYPT);
    
    // Generate verification code (6 digit)
    $verification_code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    
    try {
        // Simpan user dengan status belum terverifikasi
        $stmt = $pdo->prepare("INSERT INTO users (name, email, address, phone, username, password, verification_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $address, $phone, $username, $password, $verification_code]);
        
        // Simpan data verifikasi di session
        $_SESSION['verification_email'] = $email;
        $_SESSION['verification_code'] = $verification_code;
        
        // Redirect ke halaman verifikasi
        header('Location: verify.php');
        exit();
    } catch (PDOException $e) {
        $error = "Registration failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Create Account</button>
            <a href="login.php">Already have an account? Login</a>
        </form>
    </div>
</body>
</html>