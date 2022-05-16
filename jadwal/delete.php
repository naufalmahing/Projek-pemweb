<?php
if (isset($_POST['id'])) {
    session_start();
    if (isset($_SESSION['email'])) { 
        $email = $_SESSION['email'];
    } else {
        header('location:../login, register, forgot password/login.php');
    }

    include '../reader/koneksi.php';

    $query = "delete from events where id=? and email='$email'";
    $statement = $koneksi->prepare($query);
    $statement->bind_param('s', $_POST['id']);
    $statement->execute();
}
?>