<?php
/*
*  personEditAccount.inc
*  Update Account GUI
*/

include_once('database/dbinfo.php');
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

        $guardianEmail = $person->get_email();

		echo '<table style="width:100%" align = "center" class = "ChildrenList">';
        
        $con=connect();
		// query dbChildren to select all children with parent email address = 'email of guardian'
		$query = "SELECT first_name FROM dbChildren WHERE parent_email = '$guardianEmail'";
		$result = mysqli_query($con,$query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td>' . $row['first_name'] . '</td>';
                echo '</tr>';
			}
		}

        echo'</table>';
        
        // The add child button
        echo('<input type="hidden" name="_submit_check" value="1"><p>');
        echo('<div style= "text-align:right"><input type="submit" value="Add Child" name="addChild_button"><br /><br /></div>');
    ?>
</fieldset>

<?php 	
    // The submit button
    echo '<p style="font-size:12px"><span style="color:FF0000">*</span>Must confirm password to update your account.';
    echo('<p><table><form method="post"><input type="hidden" name="_submit_check" value="1">
                <tr><td><p>Confirm Password: <input type="password" name="passwordConfirm"></td>
                    <td><div style= "text-align:center"><input type="submit" value="Update" name="create_button"></div></td>
                    <td><div style= "text-align:center"><input type="submit" value="Cancel" name="cancel_button"></td></tr></table>');
?>
</form>