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
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php 	
    // The Add button
    echo('<input type="hidden" name="_submit_child" value="1"><p>');
    echo('<div style= "text-align:center"><input type="submit" value="Add" name="add"><br /><br /></div>');
?>
</form>