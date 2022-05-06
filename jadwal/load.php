<?php
$connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');

$data = array();

$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
}

$query = "SELECT * FROM events where email='$email' ORDER BY id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row) {
    $data[] = array(
        'id'    => $row['id'],
        'title' => $row['title'],
        'start' => $row['start_event'],
        'end'   => $row['end_event']
    );
}

echo json_encode($data);
?>