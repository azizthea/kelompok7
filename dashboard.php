<?php
session_start();
require_once 'includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user data
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    die("Error fetching user data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 1rem;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .profile-card {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            margin: 0 auto 1rem;
            background-color: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--primary-color);
        }
        
        .nav-menu {
            list-style: none;
        }
        
        .nav-item {
            margin-bottom: 0.5rem;
        }
        
        .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 5px;
            display: block;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.2);
        }
        
        .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content Styles */
        .main-content {
            padding: 2rem;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .greeting h1 {
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .greeting p {
            color: #6c757d;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card h3 {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-card p {
            font-size: 1.75rem;
            font-weight: bold;
            color: var(--dark-color);
        }
        
        .user-profile {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .profile-header h2 {
            color: var(--dark-color);
        }
        
        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .detail-group label {
            display: block;
            color: #6c757d;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .detail-group p {
            font-size: 1rem;
            color: var(--dark-color);
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
        }
    </style>
    <!-- Using Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="profile-card">
                <div class="profile-pic">
                    <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                </div>
                <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            
            <ul class="nav-menu">
                <li class="nav-item"><a href="dashboard.php" class="nav-link active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-user"></i> Profile</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-envelope"></i> Messages</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-bar"></i> Analytics</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <!-- Main Content Area -->
        <main class="main-content">
            <div class="header">
                <div class="greeting">
                    <h1>Welcome back, <?php echo htmlspecialchars($user['username']); ?>!</h1>
                    <p>Here's what's happening with your account today.</p>
                </div>
                <div class="actions">
                    <button class="btn btn-outline"><i class="fas fa-bell"></i></button>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <h3>Account Status</h3>
                    <p>Active <i class="fas fa-check-circle" style="color: var(--success-color);"></i></p>
                </div>
                <div class="stat-card">
                    <h3>Last Login</h3>
                    <p>Today</p>
                </div>
                <div class="stat-card">
                    <h3>Registered Since</h3>
                    <p><?php echo date('M d, Y', strtotime($user['created_at'])); ?></p>
                </div>
            </div>
            
            <!-- User Profile Section -->
            <div class="user-profile">
                <div class="profile-header">
                    <h2>Your Profile Information</h2>
                    <button class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</button>
                </div>
                
                <div class="profile-details">
                    <div class="detail-group">
                        <label>Full Name</label>
                        <p><?php echo htmlspecialchars($user['name']); ?></p>
                    </div>
                    <div class="detail-group">
                        <label>Username</label>
                        <p><?php echo htmlspecialchars($user['username']); ?></p>
                    </div>
                    <div class="detail-group">
                        <label>Email Address</label>
                        <p><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                    <div class="detail-group">
                        <label>Phone Number</label>
                        <p><?php echo htmlspecialchars($user['phone']); ?></p>
                    </div>
                    <div class="detail-group">
                        <label>Address</label>
                        <p><?php echo htmlspecialchars($user['address']); ?></p>
                    </div>
                    <div class="detail-group">
                        <label>Account Type</label>
                        <p>Standard User</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>