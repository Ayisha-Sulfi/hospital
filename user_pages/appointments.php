<?php
$query = "SELECT a.*, d.name AS doctor_name, d.department 
          FROM appointments a 
          JOIN doctors d ON a.doctor_id = d.id 
          WHERE a.user_id = $user_id 
          ORDER BY a.appointment_date DESC";
$result = mysqli_query($conn, $query);
?>

<h2>My Appointments</h2>

<div class="table-container">
    <?php if(mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Doctor</th>
                <th>Department</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>Dr. <?php echo $row['doctor_name']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['appointment_time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <?php if($row['status'] == 'Pending'): ?>
                            <a href="cancel_appointment.php?id=<?php echo $row['id']; ?>" 
                               onclick="return confirm('Are you sure you want to cancel this appointment?')"
                               class="btn btn-danger">Cancel</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>
</div>