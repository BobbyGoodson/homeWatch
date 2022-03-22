<?php
/*
 * Copyright 2013 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/*
 * Created on April 1, 2012
 * @author Jackson Moniaga <jmoniaga@bowdoin.edu>
 */

session_start();
session_cache_expire(30);
include_once('database/dbApplicantScreenings.php');
include_once('domain/ApplicantScreening.php');
include_once('database/dbLog.php');

$type = $_GET["type"];
$screening = retrieve_dbApplicantScreenings($type);
if (!$screening) {
    // nothing there for this type, so construct a new one with no steps
    $screening = new ApplicantScreening("new", $_SESSION['_id'], "", "unpublished");
    // and insert it into the database
    insert_dbApplicantScreenings($screening);
}
?>
<html>
    <head>
        <title> Edit Applicant Screenings</title>
        <!--  Choose a style sheet -->
        <link rel="stylesheet" href="styles.css" type="text/css"/>
    </head>
    <body>
        <div id="container">
<?php include("header.php"); ?>
            <div id="content">
            <?php
            if ($_POST['_form_submit'] == 0) {
                $action = "select";
                echo('<p><b>Select a Screening: </b>');
                include("viewScreenings.inc.php");
            } else if ($_POST['s_type'] == "new") {
                $action = $_POST['s_type'];
                echo('<p><b>Create new Screening: </b>');
                $new = true;
                include('viewScreenings.inc.php');
            } else if ($_POST['_form_submit'] == 1) {
                $action = $_POST['s_type'];
                echo('<p><b>Edit Screening: </b>' . $action);
                include('viewScreenings.inc.php');
            } else { // changes submitted, so process them and display the result
                process_form($screening);
            }
            
            /**
             * process_form gathers data and enters it into a database
             */
            function process_form($oldScreening) {

                //step one: gather data.

                $oldType = $_POST['_old_type'];
                if ($_POST['_form_type'] == "new")
                    $creator = $_SESSION['_id'];
                else
                    $creator = $oldScreening->get_creator();

                $steps = array();
                // reset steps array
                if (isset($_POST['steps']))
                    foreach ($_POST['steps'] as $step)
                        $steps[] = $step;
                else
                    $steps = $oldScreening->get_steps();

                $type = $_POST['new_type'];

                foreach ($steps as $key => $value)
                    if (empty($value))
                        unset($steps[$key]);
                $steps = implode(',', $steps);

                // set published variable 
                if ($_POST['Status'] == "published")
                    $newstatus = "published";
                else
                    $newstatus = "unpublished";

                $status = $newstatus;
                if (empty($type)) {
                    $type = $oldType;
                    // keeps "new" screening free from predefined steps and status
                    if ($type == "new") {
                        $steps = null;
                        $status = "unpublished";
                    }
                }
                //used to put together url for return to screenings link
                $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));

                //step two: try to delete, add new, or replace
                if ($_POST['deleteMe'] == "DELETE") {
                    $result = retrieve_dbApplicantScreenings($type);
                    if (!$result) {
                        echo('<p>Unable to delete. ' . $type . ' is not in the screenings database. To delete ' . $oldType . ', 
 				try to delete again but do not rename screening type.');
                    } else {
                        $result = delete_dbApplicantScreenings($type);
                        echo("<p>You have successfully removed " . $type . " from the screnings database.</p>");
                        echo('<p><a href="' . $path . 'viewScreenings.php?type=' . $type . '"><b>click here</b> to 
				return to applicant screenings.</a><br><br></p>');
                        add_log_entry('ApplicantScreening type <a href=\"viewScreenings.php?type=' . $type . '\">' . $type . '</a>\' 
				 has been deleted.');
                    }
                } else if ($_POST['_form_type'] == "new") {

                    if ($_POST['$type_s'])
                        $dup = retrieve_dbApplicantScreenings($type);
                    if ($dup)
                        echo('<p class="error">Unable to add new screening type: ' . $type . ' to the screenings database. <br>
				Another screening with the same type is already there.');
                    else {

                        $screening = new ApplicantScreening($type, $creator, $steps, $status);
                        $result = insert_dbApplicantScreenings($screening);
                        if (!$result)
                            echo ('<p class="error">Unable to add ' . $type . ' in the screenings database. <br>
           			Please report this error to the House Manager.');
                        else
                            echo("<p>You have successfully added '$type' to the screenings database.</p>");
                        echo('<p>click <a href="' . $path . 'viewScreenings.php?type=' . $type . '">here</a> to 
				return to applicant screenings.<br><br></p>');
                        add_log_entry('ApplicantScreening process <a href=\"viewScreenings.php?type=' . $type . '\">' . $type . '</a>\' 
				 has been added.');
                    }
                }
                else {
                    $result = delete_dbApplicantScreenings($oldType);
                    if (!$result)
                        echo ('<p class="error">Unable to update ' . $oldType . ' as ' . $type);
                    else {
                        $newscreening = new ApplicantScreening($type, $creator, $steps, $status);
                        $result = insert_dbApplicantScreenings($newscreening);
                        if (!$result)
                            echo ('<p class="error">Unable to update ' . $type . ' in the screenings database. <br>
           			Please report this error to the House Manager.');
                        else
                            echo('<p>You have successfully edited "' . $type . '" in the screenings database.</p>');
                        echo('<p><a href="' . $path . 'viewScreenings.php?type=' . $type . '"><b>click here</b> to 
				return to applicant screenings.</a><br><br></p>');
                        add_log_entry('ApplicantScreening process <a href=\"viewScreenings.php?type=' . $type . '\">' . $type . '</a>\' 
				 has been changed.');
                    }
                }

                //if (retrieve_dbApplicantScreenings("new")!= null)
                //	delete_dbApplicantScreenings("new");
            }
            ?>
            </div>
            <?php include('footer.inc');?>
        </div>
    </body>
</html>