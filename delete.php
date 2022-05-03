<?php
if (isset($_POST['id'])) {
    $connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');
    $query = "delete from events where id=:id";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':id'   => $_POST['id']
        )
    );
}
?>