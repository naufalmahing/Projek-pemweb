<?php
include '../reader/koneksi.php';

$data = array();


$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
}

$query = "SELECT * FROM events where email='$email' ORDER BY id";

$statement = $koneksi->prepare($query);
$statement->execute();
$result = $statement->get_result();
$result =  $result->fetch_all(MYSQLI_ASSOC);

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