<?php

$hostname = "localhost";
$username = "root";
$password = "admin123";
$database = "usersdbs";

$connection = mysqli_connect($hostname, $username, $password, $database) or die("Your Connection Failed");

?>