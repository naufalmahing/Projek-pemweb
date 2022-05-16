<?php
include 'conndbs.php';

session_start();
if (isset($_SESSION['email'])) {
  session_destroy();  
  
  session_start();
}


error_reporting(0);
  

if (isset($_POST["signin"])) {
  $email = mysqli_real_escape_string($connection, $_POST["signin_email"]);
  $password = mysqli_real_escape_string($connection, md5($_POST["signin_password"]));

  $check_login = mysqli_query($connection, "SELECT id, email FROM users WHERE email='$email' AND password='$password'");

  if(mysqli_num_rows($check_login) > 0){
      $row = mysqli_fetch_assoc($check_login);
      $_SESSION["user_id"] = $row['id'];
      header("Location:../reader/index.php");
      $_SESSION["email"] = $row['email'];
    } else {
        $_POST["signin_password"] = "";
        echo ("<script LANGUAGE='JavaScript'>window.alert('Login Incorrect'); window.location.href='login.php';</script>");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style-login.css">
  <title>Login</title>
</head>
<body>
<div class="page">
  <div class="container">
    <div class="left">
      <div class="login">Login</div>
      <div class="eula">"Nothing heals the heart better than the speech of Allah (the Qur`ān), and reflecting upon its āyāt is the first step towards healing your heart."</div>
    </div>
    <div class="right">
      <svg viewBox="0 0 320 300">
        <defs>
          <linearGradient
                          inkscape:collect="always"
                          id="linearGradient"
                          x1="13"
                          y1="193.49992"
                          x2="307"
                          y2="193.49992"
                          gradientUnits="userSpaceOnUse">
            <stop
                  style="stop-color:#ff00ff;"
                  offset="0"
                  id="stop876" />
            <stop
                  style="stop-color:#ff0000;"
                  offset="1"
                  id="stop878" />
          </linearGradient>
        </defs>
        <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 
0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.
71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
      </svg>
      <div class="form">
        <form action="" method="post">
        <label for="email">Email</label>
        <input type="email" id="email" name="signin_email" value="<?php echo $_POST["signin_email"]; ?>" required />
        <label for="password">Password</label>
        <input type="password" id="password" name="signin_password" value="<?php echo $_POST["signin_password"]; ?>" required />
        <input type="submit" id="submit" value="Submit" name="signin">
        <br><br>
        <div class="under-bar">
        &emsp;
        <a href="register.php" id="submit">Register</a>
        &ensp;
        <a href="forgotpswd.php" id="submit">Forgot Password?</a>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script>
<script src="set.js"></script>
</body>
</html>
