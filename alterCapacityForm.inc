<?php
/*
 * 	alterCapacityForm.inc
 *  Shows a form for altering capacity in dbShiftsNew database
 */
?>

<form method="post">
<?php     
    echo('<p align="center"><strong>Update Capacity</strong><br /><br />');

    echo '<select name="dayOption" id="dayOption">';
	echo '<option value="all_days">All days</option>';
	echo '<option value="Monday">Monday</option>';
	echo '<option value="Tuesday">Tuesday</option>';
	echo '<option value="Wednesday">Wednesday</option>';
    echo '<option value="Thursday">Thursday</option>';
    echo '<option value="Friday">Friday</option>';
    echo '<option value="Saturday">Saturday</option>';
    echo '<option value="Sunday">Sunday</option>';
	echo ' </select>';

    echo '<select name="timeOption" id="timeOption">';
	echo '<option value="all_times">All times</option>';
	echo '<option value="8">8:00 AM</option>';
	echo '<option value="8.5">8:30 AM</option>';
	echo '<option value="9">9:00 AM</option>';
    echo '<option value="9.5">9:30 AM</option>';
    echo '<option value="10">10:00 AM</option>';
    echo '<option value="10.5">10:30 AM</option>';
    echo '<option value="11">11:00 AM</option>';
    echo '<option value="11.5">11:30 AM</option>';
    echo '<option value="12">12:00 PM</option>';
    echo '<option value="12.5">12:30 PM</option>';
    echo '<option value="13">1:00 PM</option>';
    echo '<option value="13.5">1:30 PM</option>';
    echo '<option value="14">2:00 PM</option>';
    echo '<option value="14.5">2:30 PM</option>';
    echo '<option value="15">3:00 PM</option>';
    echo '<option value="15.5">3:30 PM</option>';
    echo '<option value="16">4:00 PM</option>';
    echo '<option value="16.5">4:30 PM</option>';
    echo '<option value="17">5:00 PM</option>';
    echo '<option value="17.5">5:30 PM</option>';
    echo '<option value="18">6:00 PM</option>';
    echo '<option value="18.5">6:30 PM</option>';
    echo '<option value="19">7:00 PM</option>';
	echo ' </select>';

	echo '<p>Capacity<span style="font-size:12px;color:FF0000">*</span>: ';
	echo '<input type="text" name="capacity" tabindex="1">';
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php
	// The update and cancel buttons
    echo('<p><table align = "center"><form method="post"><input type="hidden" name="_submit_child" value="1">
    <td><input type="submit" value="Update" name="update"><br /><br /></td>
    <td><input type="submit" value="Cancel" name="cancel_button"><br /><br /></td></table>');
?>
</form>