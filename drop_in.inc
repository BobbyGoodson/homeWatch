<?php
/*
 * 	childForm.inc
 *  shows a form for a child to be added in database
 */
?>

<form method="post">
<?php     
    echo('<br />');
    echo('<center><table class="header"><tr><td> ' . $start . '-' . $end . ' </td><td><center><strong>Drop-in Form</strong></center></td><td align="right"> ' . $date . ' </td></tr></table></center>');
    echo('<br /><br />');

    echo '<table class="dropin"><tr>';
	echo '<td align="right"><p>Guardian\'s First Name<span style="font-size:12px;color:FF0000">*</span>: </td>';
	echo '<td><input type="text" name="g_first_name" tabindex="1"></td>';
    echo '</tr>';

    echo '<tr>';
	echo '<td align="right"><p>Guardian\'s Last Name<span style="font-size:12px;color:FF0000">*</span>: </td>';
	echo '<td><input type="text" name="g_last_name" tabindex="2"></td>';
    echo '</tr>';

    echo '<tr>';
	echo '<td align="right"><p>Guardian\'s Intended Whereabouts<span style="font-size:12px;color:FF0000">*</span>: </td>';
	echo '<td><input type="text" name="g_whereabouts" tabindex="3"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td align="right"><p>Phone Number<span style="font-size:12px;color:FF0000">*</span>: </td>';
	echo '<td><input type="text" name="phone" tabindex="4"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td align="right"><p>Child\'s First Name<span style="font-size:12px;color:FF0000">*</span>: </td>';
	echo '<td><input type="text" name="c_first_name" tabindex="5"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td align="right"><p>Child\'s Last Name<span style="font-size:12px;color:FF0000">*</span>: </td>';
	echo '<td><input type="text" name="c_last_name" tabindex="6"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td align="right"><p>Child\'s Age<span style="font-size:12px;color:FF0000">*</span>: </td>';
	echo '<td><input type="text" name="c_age" tabindex="7"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td align="right"><p>Child\'s Health Requirements</span>: </td>';
    echo "<td><textarea rows='5' cols='30' name='health_requirements'></textarea></td>";
    echo '</tr>';

    echo '</table>';
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>

<?php 	
    // The submit button
    echo('<input type="hidden" name="_submit_dropin" value="1"><p>');
    echo('<div style= "text-align:center"><input type="submit" value="Reserve" name="add"><br /><br /></div>');
?>
</form>