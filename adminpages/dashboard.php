<h2>Dashboard Overview</h2>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Doctors</h3>
        <div class="number"><?php echo $doctors_count; ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Patients</h3>
        <div class="number"><?php echo $patients_count; ?></div>
    </div>
</div>

<div class="form-box">
    <h3>Add New Doctor</h3>
    <?php 
    if(isset($_GET['msg'])) {
        if($_GET['msg'] == 'success') {
            echo "<p class='alert alert-success'>Doctor added successfully!</p>";
        } elseif($_GET['msg'] == 'error') {
            echo "<p class='alert alert-danger'>Error adding doctor!</p>";
        }
    }
    ?>
    <form action="add_doctor.php" method="POST">
        <div class="form-group">
            <label>Doctor Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Department:</label>
            <select name="department" class="form-control" required>
                <option value="">Select Department</option>
                <option value="Surgeon">Surgeon</option>
                <option value="Therapist">Therapist</option>
                <option value="Gynecologist">Gynecologist</option>
                <option value="Pediatrician">Pediatrician</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <button type="submit" name="add_doctor" class="btn btn-primary">Add Doctor</button>
    </form>
</div>

<div class="table-container">
    <h3>Recent Doctors</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        <?php 
        if($doctors_result && mysqli_num_rows($doctors_result) > 0) {
            while($doctor = mysqli_fetch_assoc($doctors_result)) { 
        ?>
            <tr>
                <td><?php echo $doctor['name']; ?></td>
                <td><?php echo $doctor['email']; ?></td>
                <td><?php echo $doctor['department']; ?></td>
                <td>
                    <a href="edit_doctor.php?id=<?php echo $doctor['id']; ?>" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='4'>No doctors found</td></tr>";
        }
        ?>
    </table>
</div>