<?php

if(!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];
$stats_sql = "SELECT 
    COUNT(*) AS total,
    SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pending,
    SUM(CASE WHEN status = 'Confirmed' THEN 1 ELSE 0 END) AS confirmed,
    SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) AS completed
    FROM appointments 
    WHERE doctor_id = $doctor_id";
$stats_result = mysqli_query($conn, $stats_sql);
$stats = mysqli_fetch_assoc($stats_result);
?>

<h2>Welcome Dr. <?php echo $_SESSION['doctor_name']; ?></h2>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Appointments</h3>
        <div class="number"><?php echo $stats['total']; ?></div>
    </div>
    <div class="stat-card">
        <h3>Pending</h3>
        <div class="number"><?php echo $stats['pending']; ?></div>
    </div>
    <div class="stat-card">
        <h3>Confirmed</h3>
        <div class="number"><?php echo $stats['confirmed']; ?></div>
    </div>
    <div class="stat-card">
        <h3>Completed</h3>
        <div class="number"><?php echo $stats['completed']; ?></div>
    </div>
</div>