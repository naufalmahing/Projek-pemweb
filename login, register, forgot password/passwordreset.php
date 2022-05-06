<?php
include 'conndbs.php';

if(!isset($_GET["linkcode"])){
    exit("No Page Found!");
}

$linkcode = $_GET["linkcode"];
$getemailquery = mysqli_query($connection, "SELECT email FROM resetpasswd WHERE linkcode='$linkcode'");
if(mysqli_num_rows($getemailquery) == 0){
    exit("No Page Found!");
}


if(isset($_POST["password"])){
    $pw = $_POST["password"];
    $pw = md5($pw);

    $row = mysqli_fetch_array($getemailquery);
    $email = $row["email"];

    $query = mysqli_query($connection, "UPDATE users SET password='$pw' WHERE email='$email'");

    if($query){  
        $query = mysqli_query($connection, "DELETE FROM resetpasswd WHERE linkcode='$linkcode'");
        exit("Password has been updated");
    } else{
        exit("Something went wrong");
    }
}

?>
