<?php
/*
 * 	personForm.inc
 *  Shows a form for a person to be added in database
 *  Create Guardian Account GUI
 */
?>

<form method="post">
<?php     
    echo('<p align="center"><strong>Create New Account</strong><br /><br />');

    echo '<p>First Name<span style="font-size:12px;color:FF0000">*</span>: '; 
    echo '<input type="text" name="first_name" tabindex="1">';

    echo '<p>Last Name<span style="font-size:12px;color:FF0000">*</span>: '; 
    echo '<input type="text" name="last_name" tabindex="2">';

    echo '<p>Password<span style="font-size:12px;color:FF0000">*</span>: '; 
    echo '<input type="password" name="password" tabindex="3">';

    echo '<p>Phone Number<span style="font-size:12px;color:FF0000">*</span>: ';
    echo '<input type="text" name="phone" MAXLENGTH=12 tabindex="4">';

    echo '<p>YMCA Membership Barcode Number<span style="font-size:12px;color:FF0000">*</span>: ';
    echo '<input type="text" name="barcode" tabindex="5">';
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php 	
    // The submit button
    echo('<input type="hidden" name="_submit_check" value="1"><p>');
    echo('<div style= "text-align:center"><input type="submit" value="Create" name="create_button"><br /><br /></div>');
?>
</form>