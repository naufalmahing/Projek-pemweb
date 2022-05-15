<?php
include '../reader/koneksi.php';

$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
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