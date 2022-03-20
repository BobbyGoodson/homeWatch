<?php
//phpinfo();
//ini_set('smtp_port',465);
//$result = mail('ymcacreateaccount@yahoo.com','Test Email','This is a test','From: ymcacreateaccount@yahoo.com');
//var_dump($result);

// ini_set( 'display_errors', 1 );
// error_reporting( E_ALL );
// $from = "ymcacreateaccount@yahoo.com";
// $to = "ymcacreateaccount@yahoo.com";
// $subject = "PHP Mail Test script";
// $message = "This is a test to check the PHP Mail functionality";
// $headers = "From:" . $from;
// mail($to,$subject,$message, $headers);
// echo "Test email sent";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require 'vendor/autoload.php';
  
$mail = new PHPMailer(true);
  
try {

    $mail->isSMTP();// Set mailer to use SMTP
    $mail->CharSet = "utf-8";// set charset to utf8
    $mail->SMTPAuth = true;// Enable SMTP authentication
    $mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted

    $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
    $mail->Port = 587;// TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->isHTML(true);// Set email format to HTML

    $mail->Username = 'ymcahomewatch@gmail.com';// SMTP username
    $mail->Password = 'homewatch123';// SMTP password

    $mail->setFrom('ymcahomewatch@gmail.com', 'YMCA');//Your application NAME and EMAIL
    $mail->Subject = 'Test';//Message subject
    $mail->MsgHTML('TEST EMAIL');// Message body
    $mail->addAddress('ymcahomewatch@gmail.com', 'YMCA');// Target email


    $mail->send();

    echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>