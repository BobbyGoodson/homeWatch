<?php
/*
 * Forget Password Email Authentication step 2
 */
	
session_start();
session_cache_expire(30);
include_once('sendEmailFunction.php');
?>
<html>
	<head>
		<title>
			Forget Password Email Authentication step 2: enter code
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body id="bodyForm">
		<div id="container">
			<div id="form">
				<?php
				include('emailCode.inc');
				
				// if $_SESSION['generatedCode'] is not set
                if (!isset($_SESSION['generatedCode'])){

					// call generate_code() function and store return value in session
                    $_SESSION['generatedCode'] = generate_code();
                }

				$submit2 = $_POST['submit2'];
				$resend = $_POST['resend'];
				$userCode = $_POST['userCode'];

				// if submit2 button is pressed
				if ($submit2){
					// if userCode is equal to generated code
					if ($userCode == $_SESSION['generatedCode']){

						// redirect to reset password page
						echo "<script type=\"text/javascript\">window.location = \"forgetPassword.php\";</script>";
						// unset $_SESSION['generatedCode'] - so that it doesn't keep sending the same code to the next person
						unset($_SESSION['generatedCode']);
					} else {
						echo('<p class="error">Error: The code "' . $userCode . '" is invalid.');
					}
				// else if resend button is pressed
				} else if ($resend){
					
					// store new generated code in session
					$_SESSION['generatedCode'] = generate_code();
					// resend code to email
					email_send($_SESSION['emailaddress'], $_SESSION['generatedCode']);
				}
				?>
			</div>
		</div>
	</body>
</html>