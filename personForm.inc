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
    	echo '<input type="text" name="phone1" MAXLENGTH=12 tabindex="4">';

        echo '<p>YMCA Membership Barcode Number<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="text" name="barcode" tabindex="5">';
    }
    else {
    // for updating the account (THIS WILL CHANGE)
        //echo '<p>Password: '.$person->get_password();
        //echo '<p>Phone Number: '.phone_edit($person->get_phone1());
        //echo '<p>Phone Number: '.$person->get_barcode();
        echo '<p>Password<span style="font-size:x-small;color:FF0000">*</span>: '; 
        echo '<input type="text" name="password" tabindex="3" value="'.$person->get_password().'">';

        echo '<p>Phone Number<span style="font-size:x-small;color:FF0000">*</span>: ';
    	echo '<input type="text" name="phone1" MAXLENGTH=12 tabindex="4" value="'.phone_edit($person->get_phone1()).'">';

        echo '<p>YMCA Membership Barcode Number<span style="font-size:x-small;color:FF0000">*</span>: ';
        echo '<input type="text" name="barcode" tabindex="5" value="'.$person->barcode().'">';
    }
        
    /* This is for a second phone (NOT NEEDED)
    echo '<p>Secondary Phone: ';
    echo '<input type="text" name="phone2" MAXLENGTH=12 tabindex="8" value="'.phone_edit($person->get_phone2()).'">';
    */
        
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
    /*
    // $st = implode(',', $person->get_type());
    $types = array('volunteer' => 'House Volunteer', 'weekendmgr' => 'Weekend Manager', 'sub' => 'Flex shift', 'mealprep' => 'Guest Chef', 'events' => 'Events/Special projects', 'manager' => 'Manager');
    //$types = array('guardian' => 'Guardian', 'watcher' => 'Watcher', 'Admin' => 'Administrator');
    //$descriptions = array('volunteer' => ' -- Assists with the day-to-day operations of the House, such as
				answering phones, assisting families, giving tours, cleaning rooms and common areas, and washing linens.<p>', 
		'weekendmgr' => ' -- Serves as main point of contact during day and overnight hours. Shifts are 
						generally Friday 5pm to Saturday 5pm and/or Saturday 5pm to Sunday noon (Bangor) or 2pm (Portland). Duties include
						preparing rooms for guests, assisting families, responding to emergencies, and coordinating shift volunteers.', 
		'sub' => ' -- available on an as-needed basis to fill in (sub) for an open House Volunteer or Weekend Manager shift.',
		'mealprep' => ' -- Individual or group provides ingredients and prepares evening meal for families (approx. 15-20 people Bangor and 
						20-25 people Portland). Groups should be limited to 6-8 people.', 
		'events' => ' -- Helps with special projects and fundraising events that take place occasionally during the year.', 
		'manager' => ' -- This is a restricted level of Homebase access for House staff and experienced volunteers.');
    echo('<p>Position type:');
    // $ts = $types;
    echo('<span style="font-size:x-small;color:FF0000">*</span> (check one or more)<p>');


    foreach ($types as $key => $value) {
        echo ('&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="type[]" value=' . $key);
        if (in_array($key,$person->get_type()) !== false)
            echo(' CHECKED');
        echo ('>' . $value );
        if ($_SESSION['access_level']==0)
    	    echo $descriptions[$key].'<p>';
    }
    */

    echo('<input type="hidden" name="password" value="' . $person->get_password() . ')">');
    echo('<input type="hidden" name="_submit_check" value="1"><p>');
    echo('<input type="submit" value="Create" name="Submit Edits"><br /><br />');


    /*
    if ($_SESSION['access_level'] == 0)
        echo('By hitting <input type="submit" value="Submit" name="Submit Edits">, I understand the importance of this volunteer 
        		commitment and have answered the application questions honestly and to the best of my knowledge.<br /><br />');
    else
        echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to submit these edits.<br /><br />');
    if ($id != 'new' && $_SESSION['access_level'] >= 2) {
        echo ('<input type="checkbox" name="deleteMe" value="DELETE"> Check this box and then hit ' .
        '<input type="submit" value="Delete" name="Delete Entry"> to delete this entry. <br />' .
        '<input type="checkbox" name="reset_pass" value="RESET"> Check this box and then hit ' .
        '<input type="submit" value="Reset Password" name="Reset Password"> to reset this person\'s password.</p>');
    }
    */
?>
</form>