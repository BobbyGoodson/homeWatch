<?php
/*
 * 	alterCapacityForm.inc
 *  shows a form for altering capacity in dbShiftsNew database
 */
?>

<form method="post">
<?php     
    echo('<p align="center"><strong>Alter Capacity</strong><br /><br />');
       
	echo '<p>Location<span style="font-size:12px;color:FF0000">*</span>: ';
	echo '<input type="text" name="venue" tabindex="1">';

	echo '<p>Capacity<span style="font-size:12px;color:FF0000">*</span>: ';
	echo '<input type="text" name="capacity" tabindex="2">';
      
        echo('<p align="center"><strong>Leave Day Number and Start Time Blank to change capcacity accross all time slots at location/venue</strong><br /><br />');

      echo '<p>Day Number</span>: ';
	echo '<input type="text" name="day_num" tabindex="3">';

      echo '<p>Start Time</span>: ';
	echo '<input type="text" name="start_time_value" tabindex="2">';

?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php
	// The submit and cancel buttons for each option
    echo('<p><table align = "center"><form method="post"><input type="hidden" name="_submit_child" value="1">
    <td><input type="submit" value="Alter Time Slot" name="add1"><br /><br /></td>
    <td><input type="submit" value="Alter All" name="add2"><br /><br /></td>
    <td><input type="submit" value="Cancel" name="cancel_button"><br /><br /></td></table>');
?>
</form>