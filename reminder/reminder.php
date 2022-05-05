<?php
$connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'pastipasti');

$query = "SELECT * FROM events ORDER BY id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

date_default_timezone_set('Asia/Jakarta');
require 'sendmail.php';

foreach($result as $row) {
	if (date('d', strtotime($row['start_event'])) == date('d', strtotime('now'))) {
		send_email('naufalmahing@gmail.com'); // cek database dengan task scheduler untuk user memiliki event hari itu
	} else {
		echo 'tidak dikirim';
	}
}
?>