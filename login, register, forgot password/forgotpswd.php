<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/../vendor/autoload.php';
require 'conndbs.php';


if(isset($_POST["forgot_email"])) {

    $mailto = $_POST["forgot_email"];
    $linkcode = uniqid(true);
    $email = mysqli_real_escape_string($connection, $_POST["forgot_email"]);
    $check_email = mysqli_num_rows(mysqli_query($connection, "SELECT email FROM users WHERE email='$email'"));
    $query = mysqli_query($connection, "INSERT INTO resetpasswd(linkcode, email) VALUES('$linkcode', '$mailto')");
    if(!$query){
        echo ("<script LANGUAGE='JavaScript'>window.alert('Something Went Wrong'); window.location.href='forgotpswd.php';</script>");
    } 
    if($check_email == 0){
        exit(header("Location: /errorpage.html"));
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'readerquran.officecenter@gmail.com';                     
        $mail->Password   = 'Kelompokmusik/hobi666';                               
        $mail->SMTPSecure = 'tls';             
        $mail->Port       = 587;                                    

        //Recipients
        $mail->setFrom('readerquran.office@gmail.com', 'Quran Reader');
        $mail->addAddress($mailto);     
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');


        //Content
        $link = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/passwordreset.php?linkcode=$linkcode";
        $mail->isHTML(true);                                  
        $mail->Subject = 'Reset Your Password';
        $mail->Body    = "<h2>This Your password reset link:</h2> <br>Please click <a href='$link'>here</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo ("<script LANGUAGE='JavaScript'>window.alert('Message has been sent, please check your email'); window.location.href='login.php';</script>");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit();
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
      <div class="login">Reset Your Password</div>
      <div class="eula"></div>
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
        <input type="email" placeholder="Email" id="username" name="forgot_email" auto_complete="off" required />
        <input type="submit" id="submit" value="Submit" name="signin" placeholder="Sent Password Reset Link">
        <div class="under-bar">
            <br>
        &emsp;&ensp;&nbsp;&nbsp;
        <a href="register.php" id="submit">Register</a>
        &emsp;&emsp;
        <a href="login.php" id="submit">Login</a>
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
