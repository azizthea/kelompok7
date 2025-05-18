<?php
session_start();
require_once 'includes/functions.php';

// Cek jika tidak ada data verifikasi di session
if (!isset($_SESSION['verification_email']) || !isset($_SESSION['verification_code'])) {
    header('Location: register.php');
    exit();
}

// Proses verifikasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_code = sanitize($_POST['verification_code']);
    
    // Verifikasi kode
    if ($user_code === $_SESSION['verification_code']) {
        try {
            // Update status verifikasi di database
            $stmt = $pdo->prepare("UPDATE users SET is_verified = 1 WHERE email = ?");
            $stmt->execute([$_SESSION['verification_email']]);
            
            // Hapus session verifikasi
            unset($_SESSION['verification_email']);
            unset($_SESSION['verification_code']);
            
            // Set pesan sukses
            $_SESSION['message'] = "Registration successful! Please login.";
            header('Location: login.php');
            exit();
        } catch (PDOException $e) {
            $error = "Verification failed: " . $e->getMessage();
        }
    } else {
        $error = "Invalid verification code";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Verification</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .verification-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            border-left: 4px solid #4CAF50;
        }
        .verification-code {
            font-size: 1.5rem;
            letter-spacing: 3px;
            color: #4CAF50;
            font-weight: bold;
            text-align: center;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Local Verification</h2>
        
        <div class="verification-info">
            <p>For local development, the verification code is displayed below:</p>
            <div class="verification-code"><?php echo $_SESSION['verification_code']; ?></div>
            <p>Enter this code in the form below to verify your account.</p>
        </div>
        
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Verification Code:</label>
                <input type="text" name="verification_code" required autofocus>
            </div>
            <button type="submit">Verify Account</button>
        </form>
        
        <p style="text-align: center; margin-top: 1rem;">
            <a href="register.php">Back to Registration</a>
        </p>
    </div>
</body>
</html>