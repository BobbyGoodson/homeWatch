<?php
/*
 * 	childForm.inc
 *  Shows a form for a child to be added in database
 *	Add Child GUI
 */
?>

<form method="post">
<?php     
    echo('<p align="center"><strong>Child Form</strong><br /><br />');

	echo '<p>First Name<span style="font-size:12px;color:FF0000">*</span>: ';
	echo '<input type="text" name="first_name" tabindex="1">';

	echo '<p>Last Name<span style="font-size:12px;color:FF0000">*</span>: ';
	echo '<input type="text" name="last_name" tabindex="2">';

	echo '<p>Date of Birth (mm/dd/yyyy)<span style="font-size:12px;color:FF0000">*</span>: ';
	echo '<input type="text" name="DOB" tabindex="3">';

	echo '<p>Health Requirements</span>: ';
    echo "<textarea rows='5' cols='30' name='health_requirements'></textarea>";

?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php
	// The submit and cancel buttons
    echo('<p><table align = "center"><form method="post"><input type="hidden" name="_submit_child" value="1">
    <td><input type="submit" value="Add" name="add"><br /><br /></td>
    <td><input type="submit" value="Cancel" name="cancel_button"><br /><br /></td></table>');
?>
</form>