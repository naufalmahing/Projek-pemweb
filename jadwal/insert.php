<?php
include '../reader/koneksi.php';

// $connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');

$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
}

if(isset($_POST['title'])) {
    $query = "INSERT INTO events (title, start_event, end_event, email) VALUES (:title, :start_event, :end_event, :email)";
    $query = "INSERT INTO events (title, start_event, end_event, email) VALUES (?, ?, ?, ?)";
    $statement = $koneksi ->prepare($query);
    $statement->bind_param('ssss', $_POST['title'],
    $_POST['start'],
    $_POST['end'],
    $email);
    $statement->execute();
}
?>