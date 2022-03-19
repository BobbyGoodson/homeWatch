<?php
/*
 * Email Authentication step 2
 */

	session_start();
	session_cache_expire(30);
?>
<html>
	<head>
		<title>
			Email Authentication step 2: enter code
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body id="bodyForm">
		<div id="container">
			<div id="form">
				<?php
				/*
				sends email
				*/
				function email_send($email, $code){
					//$to = $email;
					ini_set("SMTP", "smtp.netcorecloud.net");
					ini_set("sendmail_from", "ymcahomewatchsmtp@pepisandbox.com");
         			$subject = "YMCA Child Watch Email Verification";
         			$message = "<b>http://localhost/homeWatch/personEdit.php?id=new</b>";
         			$header = "From:ymcahomewatchsmtp@pepisandbox.com\r\n"; //this is my email but you may change it, i dont know how to make it work
         			//$header .= "Cc:afgh@somedomain.com \r\n";
         			//$header .= "MIME-Version: 1.0\r\n";
         			//$header .= "Content-type: text/html\r\n";
         			$retval = mail ("ymcahomewatchsmtp@gmail.com",$subject,$message,$header);
         			if( $retval == true ) {
            			echo "Message sent successfully...";
         			}else {
            			echo "Message could not be sent...";
         			}
				}

				/*
				generate a random code
				*/
				function generate_code(){
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = '';
					for ($i = 0; $i < 6; $i++) {
						$code .= $characters[rand(0, 61)];
					}
					return $code;
				}

                //now ask the user to enter this code
				include('emailCode.inc');
				//send an email with the generated code
                if (!isset($_SESSION['generatedCode'])){
				    //$generatedCode = generate_code();
                    $_SESSION['generatedCode'] = generate_code();
				    //email_send($userEmail, $_SESSION['generatedCode']);
                }
                echo($_SESSION['generatedCode']);

				$submit2 = $_POST['submit2'];
				$resend = $_POST['resend'];

				$userCode = $_POST['userCode'];
				if ($submit2){
					if ($userCode == $_SESSION['generatedCode']){
						// redirect to create account page
						echo "<script type=\"text/javascript\">window.location = \"personEdit.php?id=new\";</script>";
					} else {
						echo('<p class="error">Error: The code "' . $userCode . '" is invalid.');
					}
				} else if ($resend){
					//resend email
					//email_send($userEmail, $_SESSION['generatedCode']);
				}
				?>
			</div>
		</div>
	</body>
</html>