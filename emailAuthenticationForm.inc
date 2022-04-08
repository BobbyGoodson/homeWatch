<form method = "post">
	<?PHP
		//This is the form for email Authentication
		echo('<p><strong>Email Authentication</strong><br /><br />');
		echo('<p>To create an account, please enter and verify your email address. Click the link sent to you via email. </p>');
        echo('<p>Do not see it? Try looking in your spam folder or sending it again by pressing Resend below. </p>');
				
        echo('<input type="hidden" name="_submit_check" value="true">');
		echo('<p>Email: <input type="text" name="email" tabindex="1"></p>');
        
		echo('<p><table class="form"><form method="post">
        <tr>
        <td colspan="2" align="left"><input type="submit" name="submit" value="Submit"></td>
		<td colspan="2" align="left"><input type="submit" name="cancel" value="Cancel"></td>
        </tr>
        </table></p>');
	?>
</form>