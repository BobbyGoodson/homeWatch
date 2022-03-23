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
    echo '<p>First Name: <input type="text" name="first_name" tabindex="1" value="'.$person->get_first_name().'">';

    echo '<p>Last Name: <input type="text" name="last_name" tabindex="2" value="'.$person->get_last_name().'">';

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
        // The add child button
        echo('<input type="hidden" name="_submit_check" value="1"><p>');
        echo('<div style= "text-align:right"><input type="submit" value="Add Child" name="addChild_button"><br /><br /></div>');
    ?>
</fieldset>

<?php 	
    // The submit button
    //echo '<p>Confirm Password: <input type="password" name="passwordConfirm">';
    //echo('<input type="hidden" name="_submit_check" value="1"><p>');
    //echo('<div style= "text-align:center"><input type="submit" value="Update" name="create_button"><br /><br /></div>');
    echo('<p><table><form method="post"><input type="hidden" name="_submit_check" value="1">
                <tr><td><p>Confirm Password: <input type="password" name="passwordConfirm"></td>
                    <td><div style= "text-align:center"><input type="submit" value="Update" name="create_button"></div></td>
                    <td><div style= "text-align:center"><input type="submit" value="Cancel" name="cancel_button"></td></tr></table>');
?>
</form>