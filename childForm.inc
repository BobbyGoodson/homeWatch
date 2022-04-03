<?php
/*
 * 	childForm.inc
 *  shows a form for a child to be added in database
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
	 //echo '<input type="text" name="health_requirements" tabindex="4">';
       echo "<textarea rows='5' cols='30' name='health_requirements' > List Health Requirements. </textarea>";

?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php 	
    // The submit button
    echo('<input type="hidden" name="_submit_child" value="1"><p>');
    echo('<div style= "text-align:center"><input type="submit" value="Add" name="add"><br /><br /></div>');
?>
</form>