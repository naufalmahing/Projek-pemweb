<?php
include 'conndbs.php';

session_start();

error_reporting(0);


if(isset($_POST["signup"])){
    $_POST["signin_email"] = "";
    $_POST["signin_password"] = ""; 
    $username = mysqli_real_escape_string($connection, $_POST["signup_un"]);
    $email = mysqli_real_escape_string($connection, $_POST["signup_email"]);
    $password = mysqli_real_escape_string($connection, md5($_POST["signup_password"]));
    $cpassword = mysqli_real_escape_string($connection, md5($_POST["signup_cpassword"]));

    $check_email = mysqli_num_rows(mysqli_query($connection, "SELECT email FROM users WHERE email='$email'"));

  if($password !== $cpassword){
      echo "<script>alert('Password did not match.')</script>";
    } 
    elseif ($check_email > 0) {
      echo "<script>alert('Please Use Another Email');</script>";
    } 
    else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($connection, $sql);
    if ($result){
        $_POST["signup_un"] = "";
        $_POST["signup_password"] = "";
        $_POST["signup_email"] = "";
        $_POST["signup_cpassword"] = "";
        echo "<script>alert('Registration Succesfully')</script>";
    }else{
        echo "<script>alert('Registration Failed')</script>";
    }
  }
}
?>
