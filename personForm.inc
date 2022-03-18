<?php
/*
 * 	personForm.inc
 *  shows a form for a person to be added or edited in the database
 * 	@author Oliver Radwan, Xun Wang and Allen Tucker
 * 	@version 9/1/2008, revised 4/1/2012, revised 3/11/2015
 */


/*if ($_SESSION['_id'] != $person->get_id()) {
    echo("<p id=\"error\">You do not have sufficient permissions to edit this user.</p>");
    include('footer.inc');
    echo('</div></div></body></html>');
    die();
} else {
    echo '<p><strong>Personnel Edit Form</strong>';
    echo(' Here you can edit your own information in the database.' .
    '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
}*/
//echo '<br> (<span style="font-size:x-small;color:FF0000">*</span>required information).';
?>



<form method="post">
<?php
    if ($person->get_first_name()=="new"){
        echo 'Create New Account';
        echo '<p>First Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="first_name" tabindex="1">';
    } else {
    	echo '<p>First Name: '.$person->get_first_name();
    }
?>  
&nbsp;&nbsp;&nbsp;&nbsp;  
Last Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="last_name" tabindex="2">
    

<?php     
    // This is the form you see
    if ($person->get_first_name()=="new") {
    // for creating a new accunt
        echo '<p>Password<span style="font-size:x-small;color:FF0000">*</span>: '; 
        echo '<input type="text" name="password" tabindex="3">';

    	echo '<p>Phone Number<span style="font-size:x-small;color:FF0000">*</span>: ';
    	echo '<input type="text" name="phone" MAXLENGTH=12 tabindex="4">';

        echo '<p>YMCA Membership Barcode Number<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="text" name="barcode" tabindex="5">';
    }
    else {
    // for updating the account (THIS WILL CHANGE)
        //echo '<p>Password: '.$person->get_password();
        //echo '<p>Phone Number: '.phone_edit($person->get_phone());
        //echo '<p>Phone Number: '.$person->get_barcode();
        echo '<p>Password<span style="font-size:x-small;color:FF0000">*</span>: '; 
        echo '<input type="text" name="password" tabindex="3" value="'.$person->get_password().'">';

        echo '<p>Phone Number<span style="font-size:x-small;color:FF0000">*</span>: ';
    	echo '<input type="text" name="phone" MAXLENGTH=12 tabindex="4" value="'.phone_edit($person->get_phone()).'">';

        echo '<p>YMCA Membership Barcode Number<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="text" name="barcode" tabindex="5" value="'.$person->barcode().'">';
        
    }
        
    /* Birthday for child, not for guardian (NOT NEEDED)
    echo '<p>Birth date: '. '<input name="birthday" type="text" id="birthday" tabindex="9" value="'.$person->get_birthday().'">';
    */

    /* We should get email from email authentication (NOT NEEDED)
    echo '<p>Email address: '. '<input type="text" name="email" tabindex="10" value="'.$person->get_email().'">';
    */
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php 	
    // The submit button
    // echo('<input type="hidden" name="password" value="' . $person->get_password() . ')">');
    echo('<input type="hidden" name="_submit_check" value="1"><p>');
    echo('<input type="submit" value="Create" name="create_button"><br /><br />');
?>
</form>