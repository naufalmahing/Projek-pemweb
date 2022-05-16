<?php
include '../reader/koneksi.php';

$data = array();

session_start();
if (isset($_SESSION['email'])) { 
    $email = $_SESSION['email'];
} else {
    header('location:../login, register, forgot password/login.php');
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