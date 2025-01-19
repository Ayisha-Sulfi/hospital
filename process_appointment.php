<?php
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

if(isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $problem = $_POST['problem'];
    
    $check_sql = "SELECT * FROM appointments 
                  WHERE doctor_id = '$doctor_id' 
                  AND appointment_date = '$appointment_date' 
                  AND appointment_time = '$appointment_time'";
    
    $check_result = mysqli_query($conn, $check_sql);
    
    if(mysqli_num_rows($check_result) > 0) {
        $_SESSION['message'] = "This time slot is already booked. Please choose another time.";
        header("Location: book_appointment.php");
        exit();
    }
    $sql = "INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, problem, status) 
            VALUES ('$user_id', '$doctor_id', '$appointment_date', '$appointment_time', '$problem', 'Pending')";
    
    if(mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Appointment booked successfully!";
        header("Location: view_appointments.php");
    } else {
        $_SESSION['message'] = "Error booking appointment: " . mysqli_error($conn);
        header("Location: book_appointment.php");
    }
}
?>