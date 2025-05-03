<?php
session_start();

// Jika user sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Website</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .hero {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        .cta-buttons a {
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-primary {
            background-color: white;
            color: #4CAF50;
        }
        .btn-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        .feature {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1>Selamat Datang di Website Kami</h1>
            <p>Platform terbaik untuk kebutuhan Anda</p>
            
            <div class="cta-buttons">
                <a href="login.php" class="btn-primary">Login</a>
                <a href="register.php" class="btn-secondary">Register</a>
            </div>
        </div>
    </div>
</body>
</html>