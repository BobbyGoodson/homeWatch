<?php
/*
 * 	adminForm.inc
 *  Shows a form for an admin to be added into the database
 *  Create Admin Account GUI
 */
?>

<form method="post">
<?php     
    echo('<p align="center"><strong>Create New Administrator Account</strong><br /><br />');

    echo '<p>First Name<span style="font-size:12px;color:FF0000">*</span>: '; 
    echo '<input type="text" name="first_name" tabindex="1">';

    echo '<p>Last Name<span style="font-size:12px;color:FF0000">*</span>: '; 
    echo '<input type="text" name="last_name" tabindex="2">';

    echo '<p>Phone Number<span style="font-size:12px;color:FF0000">*</span>: ';
    echo '<input type="text" name="phone" MAXLENGTH=12 tabindex="3">';

    echo '<p>Email<span style="font-size:12px;color:FF0000">*</span>: ';
    echo '<input type="text" name="email" tabindex="4">';

    echo '<p>Password<span style="font-size:12px;color:FF0000">*</span>: '; 
    echo '<input type="password" name="password" tabindex="5">';
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php 	
    // The submit and cancel buttons
    echo('<p><table align = "center"><form method="post"><input type="hidden" name="_submit_check" value="1">
    <td><input type="submit" value="Create" name="create_button"><br /><br /></td>
    <td><input type="submit" value="Cancel" name="cancel_button"><br /><br /></td></table>');
?>
</form>