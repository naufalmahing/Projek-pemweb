<?php
if (isset($_POST['id'])) {
    $email = 'naufalmahing@gmail.com';
    if (isset($_COOKIE['email'])) { 
        $email = $_COOKIE['email'];
    }

    $connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');
    $query = "delete from events where id=:id and email='$email'";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':id'   => $_POST['id']
        )
    );
}
?>