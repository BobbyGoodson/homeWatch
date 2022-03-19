<form method = "post">
	<?PHP
		//This is the form in email Authentication for submitting the sent code
        echo('<input type="hidden" name="_submit_check" value="true">');
		echo('<p>Code: <input type="text" name="userCode" tabindex="1"></p>');
        
		echo('<p><table><form method="post">
        <tr>
        <td colspan="2" align="left"><input type="submit" name="resend" value="Resend"></td>
        <td colspan="2" align="left"><input type="submit" name="submit2" value="Submit"></td>
        </tr>
        </table></p>');

	?>
</form>