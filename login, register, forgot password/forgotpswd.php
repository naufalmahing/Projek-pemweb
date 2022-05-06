<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
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
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'readerquran.officecenter@gmail.com';                     //SMTP username
        $mail->Password   = 'Kelompokmusik/hobi666';                               //SMTP password
        $mail->SMTPSecure = 'tls';             //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure =     PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('readerquran.office@gmail.com', 'Quran Reader');
        $mail->addAddress($mailto);     //Add a recipient
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');


        //Content
        $link = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/passwordreset.php?linkcode=$linkcode";
        $mail->isHTML(true);                                  //Set email format to HTML
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
