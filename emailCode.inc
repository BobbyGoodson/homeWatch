<?php
/*
 * 	emailCode.inc
 *  Shows a form for code verification
 *  Email Verification GUI
 */
?>

<form method = "post">
	<?PHP
		//This is the form in email Authentication for submitting the sent code
        echo('<input type="hidden" name="_submit_check" value="true">');
		echo('<p style="text-align:center">Verification Code<span style="font-size:12px;color:FF0000">*</span>:<input type="text" name="userCode" tabindex="1"></p>');
        
		echo('<p><table style="text-align:center" class="form"><form method="post">
        <tr>
        <td colspan="2""><input type="submit" name="submit2" value="Submit"></td>
        <td colspan="2"><input type="submit" name="resend" value="Resend"></td>
        </tr>
        </table></p>');
	?>
</form>