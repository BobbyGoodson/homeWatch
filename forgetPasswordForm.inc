<?php
/*
 * 	forgetPasswordForm.inc
 *  Shows a form for resetting password
 *  Reset Password GUI
 */
?>

<form method="post">
<?php     
    echo('<p align="center"><strong>Reset your password</strong><br /><br />');

    echo '<p align="center">Enter New Password<span style="font-size:12px;color:FF0000">*</span>:<input type="password" name="password" tabindex="1"></p>';

    echo '<p align="center">Confirm New Password<span style="font-size:12px;color:FF0000">*</span>:<input type="password" name="passwordConfirm" tabindex="2"></p>';
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php 	
    // The submit and cancel buttons
    echo('<p><table align = "center"><form method="post"><input type="hidden" name="_submit_check" value="1">
    <td><input type="submit" value="Reset" name="reset"><br /><br /></td>
    <td><input type="submit" value="Cancel" name="cancel_button"><br /><br /></td></table>');
?>
</form>