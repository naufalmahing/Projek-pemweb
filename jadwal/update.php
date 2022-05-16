<?php
include '../reader/koneksi.php';

session_start();
if (isset($_SESSION['email'])) { 
    $email = $_SESSION['email'];
} else {
    header('location:../login, register, forgot password/login.php');
}

if(isset($_POST['id'])) {
    $query = "UPDATE events SET title=?, start_event=?, end_event=? where id=? and email='$email'";
    $statement = $koneksi->prepare($query);

    $statement->bind_param('ssss',             
    $_POST['title'],
    $_POST['start'],
    $_POST['end'],
    $_POST['id']);

    $statement->execute();
}
?>