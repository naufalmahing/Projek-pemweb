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
        exit("Something went wrong");
    } 
    if($check_email == 0){
        exit("email doesn't exist");
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
        $mail->Body    = "<h2>This Your password reset link:</h2> <br>Please click<a href='$link'>here</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent, please check your email';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit();
}
?>
