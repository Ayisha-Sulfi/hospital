<?php

include 'config.php';

if(!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$doctor_id = $_GET['id'];
$sql = "SELECT * FROM doctors WHERE id = '$doctor_id'";
$result = mysqli_query($conn, $sql);
$doctor = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Doctor</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Edit Doctor Details</h2>
            
            <form action="update_doctor.php" method="POST">
                <input type="hidden" name="doctor_id" value="<?php echo $doctor['id']; ?>">
                
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo $doctor['name']; ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo $doctor['email']; ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Department:</label>
                    <select name="department" class="form-control" required>
                        <option value="Surgeon" <?php if($doctor['department']=='Surgeon') echo 'selected'; ?>>Surgeon</option>
                        <option value="Therapist" <?php if($doctor['department']=='Therapist') echo 'selected'; ?>>Therapist</option>
                        <option value="Gynecologist" <?php if($doctor['department']=='Gynecologist') echo 'selected'; ?>>Gynecologist</option>
                        <option value="Pediatrician" <?php if($doctor['department']=='Pediatrician') echo 'selected'; ?>>Pediatrician</option>
                        <option value="Other" <?php if($doctor['department']=='Other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>New Password: (Leave blank to keep current password)</label>
                    <input type="password" name="new_password" class="form-control">
                </div>

                <div class="button-group">
                    <button type="submit" name="update_doctor" class="btn btn-primary">Update Doctor</button>
                    <a href="admin_dashboard.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>