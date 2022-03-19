<?php
/*
 * Email Authentication 
 */

	session_start();
	session_cache_expire(30);
	include_once('database/dbPersons.php');
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
			<div id="content">
				<form method = "post">
				<?PHP
				/*
				sends email
				*/
				function email_send($email){
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

				/*function email_send($email){
					$curl = curl_init();

					curl_setopt_array($curl, array(
      				CURLOPT_URL => "https://emailapi.netcorecloud.net/v5/mail/send",
      				CURLOPT_RETURNTRANSFER => true,
      				CURLOPT_ENCODING => "",
      				CURLOPT_MAXREDIRS => 10,
     				CURLOPT_TIMEOUT => 30,
      				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      				CURLOPT_CUSTOMREQUEST => "POST",
      				CURLOPT_POSTFIELDS => "{"from":{"email":"ymcahomewatchsmtp@pepisandbox.com","name":"Flight confirmation"},"subject":"Your Barcelona flight e-ticket : BCN2118050657714","content":[{"type":"html","value":"Hello Lionel, Your flight Barcelona is confirmed."}],"personalizations":[{"to":[{"email":"ymcahomewatchsmtp@gmail.com","name":"Lionel Messi"}]}]}",
      				CURLOPT_HTTPHEADER => array(
    				"api_key: <Your API Key>",
    				"content-type: text/html"
  					),
					));
					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
 						echo "cURL Error #:" . $err;
					} else {
      					echo $response;
					}

				}*/

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
				
            	echo('<input type="hidden" name="_submit_check" value="true">');
				echo('<p>Email: <input type="text" name="email" tabindex="1"></p>');
				//echo('<p><input type="submit" name="resend" value="Resend"></p>');
				//echo('<input type="submit" name="submit" value="Submit">');
				echo('<p><table><form method="post">
            	<tr>
                <td colspan="2" align="left"><input type="submit" name="resend" value="Resend"></td>
            	<td colspan="2" align="left"><input type="submit" name="submit" value="Submit"></td>
                </tr>
                </table></p>');

				?>
				</form>
				<?php

					// store submit button in variable
					$submit = $_POST['submit'];
					// store email entered in text field in variable
					$userEmail = $_POST['email'];
					// create SESSION 'emailaddress' and store email in it
					$_SESSION['emailaddress'] = $userEmail;
	
					// if email field is not left empty AND submit button is pressed
					if ($userEmail != "" && $submit) {
	
						// check if there's already an entry
						$dup = retrieve_person($userEmail);
						if ($dup)
							// show error message
							echo('<p class="error">Error: Unable to create an account. ' . 'The email address "' . $userEmail . '" is already in use.');
						else {
							// redirect to create account page
							echo "<script type=\"text/javascript\">window.location = \"personEdit.php?id=new\";</script>";
						}
					}
					// if email field is left empty AND submit button is pressed
					else if ($userEmail == "" && $submit) {

						// show error message
						echo('<p class="error">Error: Didn\'t enter an email address.');
					}
				?>
			</div>
		</div>
	</body>
</html>