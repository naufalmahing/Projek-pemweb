<?php
include '../reader/koneksi.php';

session_start();
if (isset($_SESSION['email'])) { 
    $email = $_SESSION['email'];
} else {
    header('location:../login, register, forgot password/login.php');
}

if(isset($_POST['title'])) {
    $query = "INSERT INTO events (title, start_event, end_event, email) VALUES (?, ?, ?, ?)";
    $statement = $koneksi ->prepare($query);
    $statement->bind_param('ssss', $_POST['title'],
    $_POST['start'],
    $_POST['end'],
    $email);
    $statement->execute();
}
?>