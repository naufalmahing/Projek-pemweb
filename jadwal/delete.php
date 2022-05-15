<?php
if (isset($_POST['id'])) {
    $email = 'naufalmahing@gmail.com';
    if (isset($_COOKIE['email'])) { 
        $email = $_COOKIE['email'];
    }

    include '../reader/koneksi.php';

    $query = "delete from events where id=? and email='$email'";
    $statement = $koneksi->prepare($query);
    $statement->bind_param('s', $_POST['id']);
    $statement->execute();
}
?>