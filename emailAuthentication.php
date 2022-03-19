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
	<body id="bodyForm">
		<div id="container">
			<div id="form">
				<?php
				include('emailAuthenticationForm.inc');
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
						//echo "<script type=\"text/javascript\">window.location = \"personEdit.php?id=new\";</script>";
						//redirect to entering the code portion of email authentication
						echo "<script type=\"text/javascript\">window.location = \"emailAuthenticationCode.php\";</script>";
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