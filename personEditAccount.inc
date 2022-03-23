<?php
/*
*  personEditAccount.inc
*  Update Account GUI
*/
?>

<form method="post">
<?php
    echo('<p align="center"><strong>Update Account</strong><br /><br />');
?>

<fieldset>
    <legend>Personal information:</legend>
<?php
    echo '<p>First Name: <input type="text" name="first_name" tabindex="1" value="'.$person->get_first_name().'" style="width:200px">';
?>  
&nbsp;&nbsp;&nbsp;&nbsp;  
Last Name: <input type="text" name="last_name" tabindex="2" style="width:200px" value="<?PHP echo($person->get_last_name()) ?>">
    

<?php     
    echo '<p>Password: <input type="password" name="password" tabindex="3" value="'.$person->get_password().'">';
    echo '<p>Phone Number: <input type="text" name="phone" MAXLENGTH=12 tabindex="4" value="'.phone_edit($person->get_phone()).'">';
    echo '<p>YMCA Membership Barcode Number: <input type="text" name="barcode" tabindex="5" value="'.$person->get_barcode().'">';
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>
</fieldset>

<fieldset>
    <legend>Children:</legend>
    <?php

    echo('<input type="submit" value="Add Child" name="addChild_button"><br /><br />');
    ?>
</fieldset>

<?php 	
    // The submit button
    echo('<input type="hidden" name="_submit_check" value="1"><p>');
    echo('<input type="submit" value="Update" name="create_button"><br /><br />');
?>
</form>