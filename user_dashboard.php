<?php
include 'config.php';
if(!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="layout-container">
        <div class="sidebar">
            <div class="logo-section">
                <h2>MediCare</h2>
                <p>Patient Portal</p>
            </div>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="?page=dashboard" class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=appointments" class="nav-link <?php echo $page === 'appointments' ? 'active' : ''; ?>">
                        <i class="fas fa-calendar-check"></i> My Appointments
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=book" class="nav-link <?php echo $page === 'book' ? 'active' : ''; ?>">
                        <i class="fas fa-plus-circle"></i> Book Appointment
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=profile" class="nav-link <?php echo $page === 'profile' ? 'active' : ''; ?>">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        <div class="main-content">
            <?php
            $page_path = "user_pages/$page.php";
            if(file_exists($page_path)) {
                include $page_path;
            } else {
                echo '<p>Page not found</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>