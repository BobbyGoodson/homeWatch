<?php
/*
 * 	personForm.inc
 *  shows a form for a person to be added in database
 *  Create the account
 * 	@author Oliver Radwan, Xun Wang and Allen Tucker
 * 	@version 9/1/2008, revised 4/1/2012, revised 3/11/2015
 */
?>

<form method="post">
<?php
    //creating an account
    echo('<p><strong>Create New Account</strong><br /><br />');
    echo '<p>First Name<span style="font-size:12px;color:FF0000">*</span>: <input type="text" name="first_name" tabindex="1" style="width:200px">';
?>  
&nbsp;&nbsp;&nbsp;&nbsp;  
Last Name<span style="font-size:12px;color:FF0000">*</span>: <input type="text" name="last_name" tabindex="2" style="width:200px">
    

<?php     
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
    echo('<input type="submit" value="Create" name="create_button"><br /><br />');
?>
</form>