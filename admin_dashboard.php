<?php
include 'config.php';

if(!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$doctors_count = 0;
$patients_count = 0;
$sql_doctors = "SELECT COUNT(*) as count FROM doctors";
$result_doctors = mysqli_query($conn, $sql_doctors);
if($result_doctors) {
    $doctors_count = mysqli_fetch_assoc($result_doctors)['count'];
}

$sql_patients = "SELECT COUNT(*) as count FROM users";
$result_patients = mysqli_query($conn, $sql_patients);
if($result_patients) {
    $patients_count = mysqli_fetch_assoc($result_patients)['count'];
}

$doctors_sql = "SELECT * FROM doctors ORDER BY id DESC LIMIT 5";
$doctors_result = mysqli_query($conn, $doctors_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <div class="layout-container">
        <div class="sidebar">
            <div class="logo-section">
                <h2>MediCare</h2>
                <p>Admin Portal</p>
            </div>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="admin_dashboard.php?page=dashboard" class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin_dashboard.php?page=doctors" class="nav-link <?php echo $page === 'doctors' ? 'active' : ''; ?>">
                        <i class="fas fa-user-md"></i> Manage Doctors
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin_dashboard.php?page=patients" class="nav-link <?php echo $page === 'patients' ? 'active' : ''; ?>">
                        <i class="fas fa-users"></i> Manage Patients
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
        
            switch($page) {
                case 'dashboard':
                    include 'adminpages/dashboard.php';
                    break;
                case 'doctors':
                    include 'adminpages/doctors.php';
                    break;
                case 'patients':
                    include 'adminpages/patients.php';
                    break;
                default:
                    include 'adminpages/dashboard.php';
            }
            ?>
        </div>
    </div>
</body>
</html>