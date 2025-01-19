<?php

if(!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

$appointments_sql = "SELECT appointments.*, users.name as patient_name, users.phone 
                    FROM appointments 
                    JOIN users ON appointments.user_id = users.id 
                    WHERE appointments.doctor_id = $doctor_id 
                    AND appointments.status IN ('Pending', 'Confirmed')
                    ORDER BY appointment_date ASC";
$appointments_result = mysqli_query($conn, $appointments_sql);
?>
<h3>Current Appointments</h3>
<?php while($appointment = mysqli_fetch_assoc($appointments_result)) { ?>
    <div class="appointment-card">
                        <div class="appointment-header">
                            <h4><?php echo $appointment['patient_name']; ?></h4>
                            <span class="status status-<?php echo strtolower($appointment['status']); ?>">
                                <?php echo $appointment['status']; ?>
                            </span>
                        </div>
                        <div class="appointment-details">
                            <p><i class="fas fa-phone"></i> <?php echo $appointment['phone']; ?></p>
                            <p><i class="fas fa-calendar"></i> Requested: <?php echo $appointment['appointment_date']; ?></p>
                            <p><i class="fas fa-clock"></i> Time: <?php echo $appointment['appointment_time']; ?></p>
                            <p><i class="fas fa-notes-medical"></i> Problem: <?php echo $appointment['problem']; ?></p>
                            
                            <?php if($appointment['status'] == 'Pending') { ?>
                                <form method="POST" action="update_appointment.php" class="appointment-form">
                                    <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                    <div class="form-group">
                                        <input type="date" name="confirmed_date" class="form-control" required>
                                        <input type="time" name="confirmed_time" class="form-control" required>
                                    </div>
                                    <button type="submit" name="confirm_appointment" class="btn btn-primary">Confirm Appointment</button>
                                    <button type="submit" name="cancel_appointment" class="btn btn-danger">Cancel</button>
                                </form>
                            <?php } elseif($appointment['status'] == 'Confirmed') { ?>
                                <div class="confirmed-details">
                                    <p><strong>Confirmed Date:</strong> <?php echo $appointment['confirmed_date']; ?></p>
                                    <p><strong>Confirmed Time:</strong> <?php echo $appointment['confirmed_time']; ?></p>
                                    <form method="POST" action="update_appointment.php">
                                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                        <button type="submit" name="mark_completed" class="btn btn-success">Mark as Completed</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
