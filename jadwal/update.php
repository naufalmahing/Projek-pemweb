<?php
$connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');

$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
}

if(isset($_POST['id'])) {
    $query = "UPDATE events SET title=:title, start_event=:start_event, end_event=:end_event where id=:id and email='$email'";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':title'        => $_POST['title'],
            ':start_event'  => $_POST['start'],
            ':end_event'    => $_POST['end'],
            ':id'           => $_POST['id']
        )
    );
}
?>