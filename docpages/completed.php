<?php

if(!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

$completed_sql = "SELECT appointments.*, users.name as patient_name, users.phone 
                 FROM appointments 
                 JOIN users ON appointments.user_id = users.id 
                 WHERE appointments.doctor_id = $doctor_id 
                 AND appointments.status = 'Completed'
                 ORDER BY appointment_date DESC";
$completed_result = mysqli_query($conn, $completed_sql);
?>

<h3>Completed Appointments</h3>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Problem</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            <?php while($appointment = mysqli_fetch_assoc($completed_result)) { ?>
                <tr>
                    <td><?php echo $appointment['patient_name']; ?></td>
                    <td><?php echo $appointment['appointment_date']; ?></td>
                    <td><?php echo $appointment['appointment_time']; ?></td>
                    <td><?php echo $appointment['problem']; ?></td>
                    <td><?php echo $appointment['phone']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
