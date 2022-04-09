<?php
/*
 * Email Authentication 
 */

session_start();
session_cache_expire(30);
include_once('database/dbPersons.php');
include_once('sendEmailFunction.php');
?>
<html>
	<head>
		<title>
			Create Account Email Authentication
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body id="bodyForm">
		<div id="container">
			<div id="form">
				<?php
				include('emailAuthenticationForm.inc');
				include('personValidate.inc');

				// store submit button in variable
				$submit = $_POST['submit'];
				// store cancel button in variable
				$cancel = $_POST['cancel'];
				// store email entered in text field in variable
				$userEmail = $_POST['email'];
				// create SESSION 'emailaddress' and store email in it
				$_SESSION['emailaddress'] = $userEmail;
	
				// if $_SESSION['generatedCode'] is not set
                if (!isset($_SESSION['generatedCode'])){
				    
					// call generate_code() function and store return value in session
                    $_SESSION['generatedCode'] = generate_code();
                }

				// if email field is not left empty AND submit button is pressed
				if ($userEmail != "" && $submit) {
	
					// check if there's already an entry
					$dup = retrieve_person($userEmail);

					// validate email
					$errors = validate_email_form($userEmail);

					// errors array lists problems on the form submitted
					if ($errors) {
						// display the errors and the form to fix
						show_errors($errors);
					}
					// else if email already exists
					else if ($dup)
						// show error message
						echo('<p class="error">Error: Unable to create an account. ' . 'The email address "' . $userEmail . '" is already in use.');
					// else
					else {
						// redirect to email authentication code page
						// redirect to entering the code portion of email authentication
						echo "<script type=\"text/javascript\">window.location = \"emailAuthenticationCode.php\";</script>";
						// send code to email
						email_send($userEmail, $_SESSION['generatedCode']);
					}
				}
				// else if email field is left empty AND submit button is pressed
				else if ($userEmail == "" && $submit) {
					// show error message
					echo('<p class="error">Error: Didn\'t enter an email address.');
				}
				// else if cancel button is pressed
				else if ($cancel) {
					// redirect to home page
					echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
				}
				?>
			</div>
		</div>
	</body>
</html>