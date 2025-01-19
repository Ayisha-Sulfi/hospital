<?php
// update_doctor.php
session_start();
include 'config.php';

if(!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if(isset($_POST['update_doctor'])) {
    $doctor_id = $_POST['doctor_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    
    $sql = "UPDATE doctors SET 
            name = '$name',
            email = '$email',
            department = '$department'
            WHERE id = '$doctor_id'";
    if(!empty($_POST['new_password'])) {
        $new_password = $_POST['new_password'];
        $sql = "UPDATE doctors SET 
                name = '$name',
                email = '$email',
                department = '$department',
                password = '$new_password'
                WHERE id = '$doctor_id'";
    }
    
    if(mysqli_query($conn, $sql)) {
        header("Location: admin_dashboard.php?msg=updated");
    } else {
        header("Location: admin_dashboard.php?msg=error");
    }
    exit();
}
?>