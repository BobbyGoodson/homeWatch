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
			About
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
				<p><strong>Email Authentication</strong><br /><br />
				<p>To create an account, please enter and verify your email address. Click the link sent to you via email. </p>

                <p>Don't see it? Try looking in your spam folder or sending it again by pressing "Resend" below. </p>

                <p><table><form method="post"><input type="hidden" name="_submit_check" value="true"><tr><td>Email:</td>
        		<td><input type="text" name="user" tabindex="1"></td></tr>
                <tr><td colspan="2" align="left"><input type="submit" name="Cancel" value="Cancel"></td>
                <td colspan="2" align="right"><input type="submit" name="Submit" value="Submit"></td></tr></table></p>
			</div>
		</div>
	</body>
</html>