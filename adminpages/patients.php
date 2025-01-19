<?php
$patients_sql = "
    SELECT 
        u.id, 
        u.name, 
        u.email, 
        u.phone, 
        u.address,
        COUNT(DISTINCT a.id) as total_appointments,
        COUNT(DISTINCT CASE WHEN a.status = 'Confirmed' THEN a.id END) as confirmed_appointments,
        COUNT(DISTINCT CASE WHEN a.status = 'Completed' THEN a.id END) as completed_appointments,
        GROUP_CONCAT(DISTINCT d.name) as doctors_consulted
    FROM 
        users u
    LEFT JOIN 
        appointments a ON u.id = a.user_id
    LEFT JOIN 
        doctors d ON a.doctor_id = d.id
    GROUP BY 
        u.id
    ORDER BY 
        u.id DESC
";
$patients_result = mysqli_query($conn, $patients_sql);

$patient_requests_sql = "
    SELECT 
        a.id,
        u.name as patient_name,
        u.email as patient_email,
        d.name as doctor_name,
        a.appointment_date,
        a.appointment_time,
        a.problem,
        a.status
    FROM 
        appointments a
    JOIN 
        users u ON a.user_id = u.id
    JOIN 
        doctors d ON a.doctor_id = d.id
    WHERE 
        a.status IN ('Pending', 'Confirmed')
    ORDER BY 
        a.created_at DESC
";
$patient_requests_result = mysqli_query($conn, $patient_requests_sql);
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

<div class="table-container">
    <h3>Patients Overview</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Total Appointments</th>
                <th>Confirmed Appointments</th>
                <th>Completed Appointments</th>
                <th>Doctors Consulted</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($patients_result && mysqli_num_rows($patients_result) > 0) {
                while($patient = mysqli_fetch_assoc($patients_result)) { 
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($patient['name']); ?></td>
                    <td><?php echo htmlspecialchars($patient['email']); ?></td>
                    <td><?php echo htmlspecialchars($patient['phone'] ?? 'N/A'); ?></td>
                    <td><?php echo $patient['total_appointments']; ?></td>
                    <td><?php echo $patient['confirmed_appointments']; ?></td>
                    <td><?php echo $patient['completed_appointments']; ?></td>
                    <td><?php echo htmlspecialchars($patient['doctors_consulted'] ?? 'None'); ?></td>
                </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No patients found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="table-container">
    <h3>Patient Appointment Requests</h3>
    <table>
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Patient Email</th>
                <th>Doctor</th>
                <th>Requested Date</th>
                <th>Requested Time</th>
                <th>Problem</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($patient_requests_result && mysqli_num_rows($patient_requests_result) > 0) {
                while($request = mysqli_fetch_assoc($patient_requests_result)) { 
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($request['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($request['patient_email']); ?></td>
                    <td><?php echo htmlspecialchars($request['doctor_name']); ?></td>
                    <td><?php echo htmlspecialchars($request['appointment_date'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($request['appointment_time'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($request['problem'] ?? 'N/A'); ?></td>
                    <td class="status-<?php echo strtolower($request['status']); ?>">
                        <?php echo htmlspecialchars($request['status']); ?>
                    </td>
                </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No appointment requests found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>