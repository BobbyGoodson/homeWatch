<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHC-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 * 	personEdit.php
 *  oversees the editing of a person to be added, changed, or deleted from the database
 * 	@author Oliver Radwan, Xun Wang and Allen Tucker
 * 	@version 9/1/2008 revised 4/1/2012 revised 8/3/2015
 */
session_start();
session_cache_expire(30);
include_once('database/dbPersons.php');
include_once('domain/Person.php');
//include_once('database/dbApplicantScreenings.php');
//include_once('domain/ApplicantScreening.php');
include_once('database/dbLog.php');
$id = str_replace("_"," ",$_GET["id"]);


if ($id == 'new') {
    // for creating a new accunt
    // this is creating a starter person object.
    // function __construct($first_name, $last_name, $phone, $barcode, $email, $children, $birthday, $health_requirements, $position, $password)
    $person = new Person('new', 'applicant', null, null, null, null, null, null, null, null);
} else {
    // for editting an account
    $person = retrieve_person($id);
    if (!$person) { 
        echo('<p id="error">Error: unable to retrieve account information.</p>' . $id);
        die();
        // try again by changing blanks to _ in id
        /*
        $id = str_replace(" ","_",$_GET["id"]);
        $person = retrieve_person($id);
        if (!$person) {
            echo('<p id="error">Error: there\'s no person with this id</p>' . $id);
            die();
        }*/
    }
}
?>
<html>
    <head>
        <title>
            Editing <?PHP echo($person->get_first_name() . " " . $person->get_last_name()); ?>
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
		<script>
			//$(function(){
			//	$( "#birthday" ).datepicker({dateFormat: 'y-mm-dd',changeMonth:true,changeYear:true,yearRange: "1920:+nn"});
			//	$( "#start_date" ).datepicker({dateFormat: 'y-mm-dd',changeMonth:true,changeYear:true,yearRange: "1920:+nn"});
			//	$( "#end_date" ).datepicker({dateFormat: 'y-mm-dd',changeMonth:true,changeYear:true,yearRange: "1920:+nn"});
			//	$( "#screening_status[]" ).datepicker({dateFormat: 'y-mm-dd',changeMonth:true,changeYear:true,yearRange: "1920:+nn"});
			//})
		</script>
    </head>
    <body>
        <div id="container">
            <?PHP include('header.php'); ?>
            <div id="content">
                <?PHP
                //include('personValidate.inc');
                if ($_POST['_submit_check'] != 1){
                //if (isset($_POST['create_button'])) {
                    //in this case, the form has not been submitted, so show it
                    include('personForm.inc');
                } else {
                    //in this case, the form has been submitted, so validate it
                    $errors = validate_form($person);  //step one is validation.
                    // errors array lists problems on the form submitted
                    if ($errors) {
                        // display the errors and the form to fix
                        show_errors($errors);
                        include('personForm.inc');
                    }
                    // this was a successful form submission; update the database and exit
                    else
                        echo('hey');
                        //process_form($id,$person);
                    //    echo($_POST['first_name']);
                        //echo "</div>";
                    //echo('</div></body></html>');
                    die();
                }

                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                /*function process_form($id,$person) {
                    //echo($_POST['first_name']);
                    //step one: sanitize data by replacing HTML entities and escaping the ' character
                   	$first_name = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['first_name']))));
                    $last_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['last_name'])));

                    $phone = trim(str_replace(' ', '', htmlentities($_POST['phone'])));
                    $email = $id;
                    $position = 'guardian';
                    $barcode = trim(str_replace('\\\'', '\'', htmlentities($_POST['barcode'])));

                    //$birthday = $_POST['birthday'];
                    //used for url path in linking user back to edit form
                    //$path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));
                    //step two: try to make the deletion, password change, addition, or change

                    
                    // try to reset the person's password
                    //else if ($_POST['reset_pass'] == "RESET") {
                    //    $id = $_POST['old_id'];
                    //    $result = remove_person($id);
                    //    $pass = $first_name . $clean_phone1;
                    //    $newperson = new Person($first_name, $last_name, $location, $address, $city, $state, $zip, $clean_phone1, $phone1type, $clean_phone2,$phone2type,
                    //    				$email, $type, $screening_type, $screening_status, $status, $employer, $position, $credithours,
                    //                    $commitment, $motivation, $specialties, $convictions, $availability, $schedule, $hours, 
                    //                    $birthday, $start_date, $howdidyouhear, $notes, "");
                    //    $result = add_person($newperson);
                    //    if (!$result)
                    //        echo ('<p class="error">Unable to reset ' . $first_name . ' ' . $last_name . "'s password.. <br>Please report this error to the House Manager.");
                    //    else
                    //        echo("<p>You have successfully reset " . $first_name . " " . $last_name . "'s password.</p>");
                    //}
                    

                    // try to add a new person to the database
                    if($person->get_first_name()=="new") {
                        //$id = $first_name . $clean_phone1;
                        $id = $email;

                        //check if there's already an entry
                        $dup = retrieve_person($id);
                        if ($dup)
                            echo('<p class="error">Unable to add ' . $first_name . ' ' . $last_name . ' to the database. <br>Email already in use.');
                        else {
                            $newperson = new Person($first_name, $last_name, $phone, $barcode, $email, $children, $birthday, $health_requirements, $position, $password);
                            $result = add_person($newperson);
                            
                            //if (!$result)
                            //    echo ('<p class="error">Unable to add " .$first_name." ".$last_name. " in the database. <br>Please report this error to the House Manager.');
                            //else if ($_SESSION['access_level'] == 0)
                            //    echo("<p>Your application has been successfully submitted.<br>  The House Manager will contact you soon.  Thank you!");
                            //else
                            //    echo('<p>You have successfully added <a href="' . $path . 'personEdit.php?id=' . $id . '"><b>' . $first_name . ' ' . $last_name . ' </b></a> to the database.</p>');
                            }
                    }

                    // try to replace an existing person in the database by removing and adding
                    
                    //WE WILL COME BACK TO THIS
                    //else {
                    //    $id = $_POST['old_id'];
                    //    $pass = $_POST['old_pass'];
                    //    $result = remove_person($id);
                    //    if (!$result)
                    //        echo ('<p class="error">Unable to update ' . $first_name . ' ' . $last_name . '. <br>Please report this error to the House Manager.');
                    //    else {
                    //        $newperson = new Person($first_name, $last_name, $location, $address, $city, $state, $zip, $clean_phone1, $phone1type, $clean_phone2,$phone2type,
                    //    				$email, $type, $screening_type, $screening_status, $status, $employer, $position, $credithours,
                    //                    $commitment, $motivation, $specialties, $convictions, $availability, $schedule, $hours, 
                    //                    $birthday, $start_date, $howdidyouhear, $notes, $pass);
                    //        $result = add_person($newperson);
                    //        if (!$result)
                    //            echo ('<p class="error">Unable to update ' . $first_name . ' ' . $last_name . '. <br>Please report this error to the House Manager.');
                    //        //else echo("<p>You have successfully edited " .$first_name." ".$last_name. " in the database.</p>");
                    //        else
                    //            echo('<p>You have successfully edited <a href="' . $path . 'personEdit.php?id=' . $id . '"><b>' . $first_name . ' ' . $last_name . ' </b></a> in the database.</p>');
                    //        add_log_entry('<a href=\"personEdit.php?id=' . $id . '\">' . $first_name . ' ' . $last_name . '</a>\'s Personnel Edit Form has been changed.');
                    //    }
                    //}
                }*/
                ?>
            </div>

        </div>
    </body>
</html>
