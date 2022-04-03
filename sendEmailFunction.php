<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* sends email function */
function email_send($email, $code){
					
	require 'vendor/autoload.php';
					
	$mail = new PHPMailer(true);
					
	try {

		$mail->isSMTP(); // set mailer to use SMTP
		$mail->CharSet = "utf-8"; // set charset to utf8
		$mail->SMTPAuth = true; // enable SMTP authentication
		$mail->SMTPSecure = 'tls'; // enable TLS encryption, `ssl` also accepted

		$mail->Host = 'smtp.gmail.com'; // specify main and backup SMTP servers
		$mail->Port = 587; // TCP port to connect to
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$mail->isHTML(true); // set email format to HTML

		$mail->Username = 'ymcahomewatch@gmail.com'; // SMTP username
		$mail->Password = 'homewatch123'; // SMTP password

		$mail->setFrom('ymcahomewatch@gmail.com', 'YMCA Child Watch'); // your application NAME and EMAIL
		$mail->Subject = 'Verification code'; // message subject
		$mail->MsgHTML('<p>Hello,</p><p>Thank you for signing up with the YMCA Child Watch. To verify your email address and to be able to continue with the process, please use the following verification code:</p><p><b>' . $_SESSION['generatedCode']); // message body
		$mail->addAddress($email); // target email

		$mail->send();
        
	} catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}


/* generate a random code function */
function generate_code(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$code = '';
	for ($i = 0; $i < 6; $i++) {
	    $code .= $characters[rand(0, 61)];
	}
	return $code;
}
?>