<?php
include 'config.php';
if(!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_id = $_SESSION['doctor_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $specialization = $_POST['specialization'];

    if(empty($name) || empty($email) || empty($phone) || empty($address) || empty($specialization)) {
        header("Location: doctor_dashboard.php?page=profile&status=error");
        exit();
    }
    $sql = "UPDATE doctors SET 
            name = '$name',
            email = '$email',
            phone = '$phone',
            address = '$address',
            specialization = '$specialization'
            WHERE id = $doctor_id";
            
    if(mysqli_query($conn, $sql)) {
        header("Location: doctor_dashboard.php?page=profile&status=success");
    } else {
        header("Location: doctor_dashboard.php?page=profile&status=error");
    }
} else {
    header("Location: doctor_dashboard.php?page=profile");
}
?>