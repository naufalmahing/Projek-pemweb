<?php
$connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');

$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
}

if(isset($_POST['title'])) {
    $query = "INSERT INTO events (title, start_event, end_event, email) VALUES (:title, :start_event, :end_event, :email)";
    $statement = $connect ->prepare($query);
    $statement->execute(
        array(
            ':title'        => $_POST['title'],
            ':start_event'  => $_POST['start'],
            ':end_event'    => $_POST['end'],
            ':email'        => $email
        )
    );
}
?>