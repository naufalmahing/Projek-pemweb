<form action="" method="post">
    <input type="text" name="signin_email" id="">
    <input type="password" name="signin_password" id="">
    <input type="submit" value="Login" name="signin">
</form>

<?php

include 'conndbs.php';

session_start();

error_reporting(0);
  

if (isset($_POST["signin"])) {
  $email = mysqli_real_escape_string($connection, $_POST["signin_email"]);
  $password = mysqli_real_escape_string($connection, md5($_POST["signin_password"]));

  $check_login = mysqli_query($connection, "SELECT id FROM users WHERE email='$email' AND password='$password'");

  if(mysqli_num_rows($check_login) > 0){
      $row = mysqli_fetch_assoc($check_login);
      $_SESSION["user_id"] = $row['id'];
      header("Location:index.php");
    } else {
        $_POST["signin_password"] = "";
        die("Login Incorrect");
    }
}
?>