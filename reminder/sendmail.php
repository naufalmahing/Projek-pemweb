<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

function send_email($ke) {
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

        
        $mail->setFrom('readerquran.office@gmail.com', 'Quran Reader');
        $mail->addAddress($ke);     
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

        
        $mail->isHTML(true);                                  
        $mail->Subject = 'Notifikasi event';
        $mail->Body    = 'Anda memiliki kegiatan <b>in bold!</b> hari ini pukul..';
        $mail->AltBody = 'Anda memiliki kegiatan <b>in bold!</b> hari ini pukul..';

        $send = $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}