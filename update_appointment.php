<?php

include 'config.php';

if(!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

if(isset($_POST['appointment_id'])) {
    $appointment_id = $_POST['appointment_id'];

    if(isset($_POST['confirm_appointment'])) {
        $confirmed_date = $_POST['confirmed_date'];
        $confirmed_time = $_POST['confirmed_time'];
        
        $sql = "UPDATE appointments 
                SET status='Confirmed', 
                    confirmed_date='$confirmed_date', 
                    confirmed_time='$confirmed_time' 
                WHERE id=$appointment_id";
                
        if(mysqli_query($conn, $sql)) {
            header("Location: doctor_dashboard.php?msg=success");
        } else {
            header("Location: doctor_dashboard.php?msg=error");
        }
    }

    if(isset($_POST['mark_completed'])) {
        $sql = "UPDATE appointments SET status='Completed' WHERE id=$appointment_id";
        if(mysqli_query($conn, $sql)) {
            header("Location: doctor_dashboard.php?msg=success");
        } else {
            header("Location: doctor_dashboard.php?msg=error");
        }
    }
    if(isset($_POST['cancel_appointment'])) {
        $sql = "UPDATE appointments SET status='Cancelled' WHERE id=$appointment_id";
        if(mysqli_query($conn, $sql)) {
            header("Location: doctor_dashboard.php?msg=success");
        } else {
            header("Location: doctor_dashboard.php?msg=error");
        }
    }
} else {
    header("Location: doctor_dashboard.php");
}
?>