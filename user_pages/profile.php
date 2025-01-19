<?php
$profile_query = "SELECT * FROM users WHERE id = $user_id";
$profile_result = mysqli_query($conn, $profile_query);
$profile = mysqli_fetch_assoc($profile_result);

if(isset($_SESSION['message'])) {
    echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}
?>

<h2>My Profile</h2>

<div class="profile-box">
    <form action="update_profile.php" method="POST">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $profile['name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $profile['email']; ?>" required>
        </div>

        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $profile['phone']; ?>" required>
        </div>

        <div class="form-group">
            <label>Address:</label>
            <textarea name="address" required><?php echo $profile['address']; ?></textarea>
        </div>

        <div class="form-group">
            <label>New Password (leave blank to keep current):</label>
            <input type="password" name="password">
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
    </form>
</div>