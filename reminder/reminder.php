<?php
$connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');

$email = 'naufalmahing@gmail.com';
if (isset($_COOKIE['email'])) { 
    $email = $_COOKIE['email'];
}

$query = "SELECT * FROM events ORDER BY id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

date_default_timezone_set('Asia/Jakarta');
require 'sendmail.php';

foreach($result as $row) {
	if (date('d', strtotime($row['start_event'])) == date('d', strtotime('now'))) {
		send_email($row['email'], $row['title'], $row['start_event'], $row['end_event']);

	} else {
		echo 'tidak dikirim';
	}
}
?>