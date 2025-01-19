<?php
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT a.*, d.name as doctor_name, d.department 
        FROM appointments a 
        JOIN doctors d ON a.doctor_id = d.id 
        WHERE a.user_id = '$user_id' 
        ORDER BY a.appointment_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Appointments</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>My Appointments</h2>
        
        <?php 
        if(isset($_SESSION['message'])) {
            echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>

        <div class="table-container">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Problem</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td>Dr. <?php echo $row['doctor_name']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo $row['appointment_date']; ?></td>
                                <td><?php echo date('h:i A', strtotime($row['appointment_time'])); ?></td>
                                <td><?php echo $row['problem']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <?php if($row['status'] == 'Pending'): ?>
                                        <a href="cancel_appointment.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-danger"
                                           onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                            Cancel
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No appointments found.</p>
            <?php endif; ?>
        </div>
        
        <div class="button-group">
            <a href="book_appointment.php" class="btn btn-primary">Book New Appointment</a>
            <a href="user_dashboard.php" class="btn">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>