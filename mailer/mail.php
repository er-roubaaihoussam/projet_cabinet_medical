<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//Server settings

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
// $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->Host = 'tls://smtp.gmail.com:587';
$mail->SMTPOptions = array(
   'ssl' => array(
     'verify_peer' => false,
     'verify_peer_name' => false,
     'allow_self_signed' => true
    )
);

$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'noreply.cabinetmedical@gmail.com';                     //SMTP username
$mail->Password   = 'abdou2001';                               //SMTP password
// $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
// $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Content
    $mail->isHTML(true); 