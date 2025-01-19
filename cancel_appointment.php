<?php
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

if(isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $check_sql = "SELECT * FROM appointments 
                  WHERE id = '$appointment_id' 
                  AND user_id = '$user_id' 
                  AND status = 'Pending'";
    
    $check_result = mysqli_query($conn, $check_sql);
    
    if(mysqli_num_rows($check_result) > 0) {
        $sql = "UPDATE appointments SET status = 'Cancelled' WHERE id = '$appointment_id'";
        
        if(mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Appointment cancelled successfully.";
        } else {
            $_SESSION['message'] = "Error cancelling appointment: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['message'] = "Invalid appointment or already processed.";
    }
}

header("Location: view_appointments.php");
?>