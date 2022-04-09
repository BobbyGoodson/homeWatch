<form method = "post">
	<?PHP
		//This is the form for email Authentication
		echo('<p style="text-align:center"><strong>Email Authentication</strong><br /><br />');
		echo('<p style="text-align:center">To create an account, please enter and verify your email address. You will receive a verification code to confirm your email address.</p>');
				
        echo('<input type="hidden" name="_submit_check" value="true">');
		echo('<p style="text-align:center">Email<span style="font-size:12px;color:FF0000">*</span>:<input type="text" name="email" tabindex="1"></p>');
        
		echo('<p><table style="text-align:center" class="form"><form method="post">
        <tr>
        <td colspan="2"><input type="submit" name="submit" value="Submit"></td>
		<td colspan="2"><input type="submit" name="cancel" value="Cancel"></td>
        </tr>
        </table></p>');
	?>
</form>