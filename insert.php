<?php
$connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');

if(isset($_POST['title'])) {
    $query = "INSERT INTO events (title, start_event, end_event, email) VALUES (:title, :start_event, :end_event, :email)";
    $statement = $connect ->prepare($query);
    $statement->execute(
        array(
            ':title'        => $_POST['title'],
            ':start_event'  => $_POST['start'],
            ':end_event'    => $_POST['end'],
            ':email'        => $_POST['email']
        )
    );
}
?>