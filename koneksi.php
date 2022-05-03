<?php
$server = "localhost";
$username = "root";
$password = "pastipasti";
$database = "test";

$koneksi = mysqli_connect($server,$username,$password,$database) or die(mysqli_error($koneksi));
