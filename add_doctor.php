<?php
include 'config.php';

if(!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if(isset($_POST['add_doctor'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $department = $_POST['department'];
    $sql = "INSERT INTO doctors (name, email, password, department) 
            VALUES ('$name', '$email', '$password', '$department')";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: admin_dashboard.php?msg=success");
    } else {
        header("Location: admin_dashboard.php?msg=error");
    }
    exit();
}
?>