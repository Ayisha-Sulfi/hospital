<?php
// Fetch doctors with their appointment statistics
$doctors_full_sql = "
    SELECT 
        d.id, 
        d.name, 
        d.email, 
        d.department, 
        d.specialization,
        COUNT(DISTINCT a.id) as total_appointments,
        COUNT(DISTINCT CASE WHEN a.status = 'Confirmed' THEN a.id END) as confirmed_appointments,
        COUNT(DISTINCT CASE WHEN a.status = 'Completed' THEN a.id END) as completed_appointments,
        COUNT(DISTINCT u.id) as unique_patients
    FROM 
        doctors d
    LEFT JOIN 
        appointments a ON d.id = a.doctor_id
    LEFT JOIN 
        users u ON a.user_id = u.id
    GROUP BY 
        d.id
    ORDER BY 
        total_appointments DESC
";
$doctors_result = mysqli_query($conn, $doctors_full_sql);
?>

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

        <div class="form-group">
            <label>Specialization:</label>
            <input type="text" name="specialization" class="form-control">
        </div>

        <div class="form-group">
            <label>Phone:</label>
            <input type="tel" name="phone" class="form-control">
        </div>

        <div class="form-group">
            <label>Address:</label>
            <textarea name="address" class="form-control"></textarea>
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
            <th>Specialization</th>
            <th>Total Appointments</th>
            <th>Actions</th>
        </tr>
        <?php 
        if($doctors_result && mysqli_num_rows($doctors_result) > 0) {
            while($doctor = mysqli_fetch_assoc($doctors_result)) { 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($doctor['name']); ?></td>
                <td><?php echo htmlspecialchars($doctor['email']); ?></td>
                <td><?php echo htmlspecialchars($doctor['department']); ?></td>
                <td><?php echo htmlspecialchars($doctor['specialization'] ?? 'N/A'); ?></td>
                <td><?php echo $doctor['total_appointments']; ?></td>
                <td>
                    <a href="edit_doctor.php?id=<?php echo $doctor['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="delete_doctor.php?id=<?php echo $doctor['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</a>
                </td>
            </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No doctors found</td></tr>";
        }
        ?>
    </table>
</div>