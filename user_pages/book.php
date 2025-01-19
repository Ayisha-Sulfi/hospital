<?php
if(!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$sql = "SELECT id, name, department FROM doctors ORDER BY department";
$result = mysqli_query($conn, $sql);

$doctors = array();
while($row = mysqli_fetch_assoc($result)) {
    $doctors[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Book an Appointment</h2>
        
        <?php 
        if(isset($_SESSION['message'])) {
            echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>

        <div class="form-box">
            <form action="process_appointment.php" method="POST">
                <div class="form-group">
                    <label>Select Doctor:</label>
                    <select name="doctor_id" required class="form-control">
                        <option value="">Choose a doctor</option>
                        <?php foreach($doctors as $doctor): ?>
                            <option value="<?php echo $doctor['id']; ?>">
                                Dr. <?php echo $doctor['name']; ?> (<?php echo $doctor['department']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Appointment Date:</label>
                    <input type="date" name="appointment_date" required class="form-control"
                           min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="form-group">
                    <label>Preferred Time:</label>
                    <input type="time" name="appointment_time" required class="form-control"
                          >
                </div>

                <div class="form-group">
                    <label>Medical Problem:</label>
                    <textarea name="problem" required class="form-control" 
                              placeholder="Describe your medical problem"></textarea>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Book Appointment</button>
            </form>
        </div>
        
        <a href="user_dashboard.php" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>