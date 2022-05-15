<?php
include '../reader/koneksi.php';

// $connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');

$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
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