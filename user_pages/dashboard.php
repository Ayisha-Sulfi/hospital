<?php
$stats_query = "SELECT 
    COUNT(*) AS total,
    SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pending,
    SUM(CASE WHEN status = 'Confirmed' THEN 1 ELSE 0 END) AS confirmed,
    SUM(CASE WHEN status = 'Cancelled' THEN 1 ELSE 0 END) AS cancelled
    FROM appointments 
    WHERE user_id = $user_id";
$stats_result = mysqli_query($conn, $stats_query);
$stats = mysqli_fetch_assoc($stats_result);
?>

<h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>
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
        <h3>Cancelled</h3>
        <div class="number"><?php echo $stats['cancelled']; ?></div>
    </div>
</div>
<div class="table-container">
    <h3>Recent Appointments</h3>
    <?php
    $recent_query = "SELECT a.*, d.name AS doctor_name, d.department 
                    FROM appointments a 
                    JOIN doctors d ON a.doctor_id = d.id 
                    WHERE a.user_id = $user_id 
                    ORDER BY a.created_at DESC 
                    LIMIT 5";
    $recent_result = mysqli_query($conn, $recent_query);
    
    if(mysqli_num_rows($recent_result) > 0): ?>
        <table>
            <tr>
                <th>Doctor</th>
                <th>Department</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($recent_result)): ?>
                <tr>
                    <td>Dr. <?php echo $row['doctor_name']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>
</div>