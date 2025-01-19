<?php
if(!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];
$sql = "SELECT * FROM doctors WHERE id = $doctor_id";
$result = mysqli_query($conn, $sql);
$doctor = mysqli_fetch_assoc($result);

if(isset($_GET['status'])) {
    if($_GET['status'] == 'success') {
        echo "<div class='alert status-confirmed'>Profile updated successfully!</div>";
    } else {
        echo "<div class='alert status-cancelled'>Failed to update profile!</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="profile-box">
        <h2>My Profile</h2>
        
        <form action="update_profile.php" method="POST">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" value="<?php echo $doctor['name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $doctor['email']; ?>" required>
            </div>

            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" value="<?php echo $doctor['phone']; ?>" required>
            </div>

            <div class="form-group">
                <label>Address:</label>
                <textarea name="address" required><?php echo $doctor['address']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Specialization:</label>
                <input type="text" name="specialization" value="<?php echo $doctor['specialization']; ?>" required>
            </div>

            <button type="submit" class="update-btn">Update Profile</button>
        </form>
    </div>
</body>
</html>