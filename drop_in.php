<?php
/*
 * 	drop_in.php
 *  Adds walk-ins 
 */
session_start();
session_cache_expire(30);
include_once('database/dbChildren.php');
include_once('domain/Child.php');
include_once('database/dbChildren_in_shifts.php');
include_once('database/dbShiftsNew.php');
?>
<html>
    <head>
        <title>
            Drop-in Form
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>
            table.header{
                table-layout: fixed;
                width:90%;
            }
            table.td{
                width:30%;
            }
            table.dropin{
                width:80%;
                align:center;
            }
            input[type=text] {
                width:100%;
            }
            textarea{
                padding:5px; 
                background:#ffffff; 
                border-left:3px solid #428BCA;
                border-bottom:3px solid #428BCA;
                border-right:3px solid #428BCA;
                border-top:3px solid #428BCA;
                cursor:pointer;
                font-size:24px;
                color: 	#000000;
            }
        </style>
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
    </head>
    <body id="bodyForm">
            <div id="formperson">
                <?PHP

                //let's get some information about the time slot, taken from the url
                $end = $_GET['end'];
                $start = $_GET['start'];
                $date = $_GET['date'];
                $dayofweek = $_GET['dayofweek'];

                
                include('personValidate.inc');
		        //include_once('database/dbinfo.php');

                if ($_POST['_submit_dropin'] != 1){
                    //in this case, the form has not been submitted, so show it
                    include('drop_in.inc');
                } else {
                    // if cancel button was clicked - redirect to watchers's homepage
                    if (isset($_POST['cancel_button'])){
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                    // else
                    else {
                        //validate drop in form
                        $errors = validate_dropin_form();

                        // errors array lists problems on the form submitted
                        if ($errors) {
                            // display the errors and the form to fix
                            show_errors($errors);
                            include('drop_in.inc');
                            die();
                        } 
                        // else
                        else {
                            // process form
                            process_dropin();
                        }
                    }
                }
                
                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_dropin() {

                    //Process the form
		    //first make sure there is space
		    $day_num = intval($_GET['day_num']);
		    $time = floatval($_GET['time']);
		    $venue = $_GET['venue'];
		    $number_added = 1;
		    
		    $reserveAttempt = increment_reserved($number_added, $day_num, $time, $venue);
			echo($reserveAttempt);
		    //TODO: ACTUALLY ERROR CHECK FOR RESERVEATTEMPT
                    $first_name = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['c_first_name']))));
                    $last_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['c_last_name'])));
                    $DOB = trim(str_replace('\\\'', '\'', htmlentities($_POST['c_DOB'])));
                    $temp_health_requirements = trim($_POST['health_requirements']);
                    $health_requirements = nl2br($temp_health_requirements);
                    $parent_email = $_POST['email'];
		
                    $newchild = new Child($first_name, $last_name, $DOB, $health_requirements, $parent_email);
                    add_child($newchild);
		    //add child to db
		    $newID = $newchild->get_id();
		    add_entry($newID,$day_num,$time);
                    // redirect to watcher home page
                    echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                }
                ?>
            </div>
    </body>
</html>
