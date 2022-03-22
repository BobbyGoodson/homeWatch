<?php
/*
 * Email Authentication 
 */

	session_start();
	session_cache_expire(30);
?>
<html>
	<head>
		<title>
			Email Authentication
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
				<?PHP
				/*
				sends email
				*/
				function email_send($email){
					//$to = $email;
         			$subject = "YMCA Child Watch Eemail Verification";
         			$message = "<b>http://localhost/homeWatch/personEdit.php</b>";
         			$header = "From:tdrink24@gmail.com \r\n"; //this is my email but you may change it, i dont know how to make it work
         			//$header .= "Cc:afgh@somedomain.com \r\n";
         			$header .= "MIME-Version: 1.0\r\n";
         			$header .= "Content-type: text/html\r\n";
         			$retval = mail ($email,$subject,$message,$header);
         			if( $retval == true ) {
            			echo "Message sent successfully...";
         			}else {
            			echo "Message could not be sent...";
         			}
				}

				/*
				generate a random code
				*/
				/*function generate_code(){
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = '';
					for ($i = 0; $i < 6; $i++) {
						$code .= $characters[rand(0, 61)];
					}
					return $code;
				}*/


				echo('<p><strong>Email Authentication</strong><br /><br />');
				echo('<p>To create an account, please enter and verify your email address. Click the link sent to you via email. </p>');
               	echo('<p>Do not see it? Try looking in your spam folder or sending it again by pressing Resend below. </p>');

            	echo('<p><table><form method="post"><input type="hidden" name="_submit_check" value="true">
				<tr><td>Email:</td><td><input type="text" name="email" tabindex="1"></td></tr>
            	<tr><td colspan="2" align="left"><input type="submit" name="resend" value="resend"></td>
            	<td colspan="2" align="right"><input type="submit" name="submit" value="submit"></td></tr></table></p>');

				$submit = $_POST['submit'];
				$resend = $_POST['resend'];
				if ($submit || $resend){
					$userEmail = $_POST['email'];
					email_send($userEmail);
				}

				?>
			</div>
		</div>
		</div>
	</body>
</html>