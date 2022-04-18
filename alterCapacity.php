<?php
/*
 * 	alterCapacity.php
 *  Alter capacity of dbShiftsNew database
 */
session_start();
session_cache_expire(30);
include_once('database/dbShiftsNew.php');
?>
<html>
    <head>
        <title>
            Updating Capacity
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>
			select {
    			padding:5px; 
    			background:#428BCA; 
    			cursor:pointer;
    			font-size:24px;
    			color: 	#ffffff;
			}
        </style>
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
    </head>
    <body id="bodyForm">
            <div id="form">
                <?PHP
                include('personValidate.inc');  
                if ($_POST['_submit_child'] != 1){
                    //in this case, the form has not been submitted, so show it
                    include('alterCapacityForm.inc');
                } else {
                    // if cancel button was clicked - redirect to admin's home page
                    if (isset($_POST['cancel_button'])){
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                    else {
                        // validate update capacity form
                        $errors = validate_capacity_form();
                        
                        // errors array lists problems on the form submitted
                        if ($errors) {
                            // display the errors and the form to fix
                            show_errors($errors);
                            include('alterCapacityForm.inc');
                            die();
                        }
                        else {
                            // store value of day dropdown menu selected
                            $day = $_POST['dayOption'];
                            // store value of time dropdown menu selected
                            $time = $_POST['timeOption'];
                            // store capacity entered in text field
                            $capacity = trim(str_replace('\\\'', '\'', htmlentities($_POST['capacity'])));;
        
                            // if "all days" and "all times" were selected
                            if ($day == "all_days" && $time == "all_times") {
    
                                // update capacity for all days and all times
                                editCapacity($capacity);
                                // redirect to admin's home page
                                echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                            }
                            // if actual day and "all times" were selected
                            else if ($time == "all_times") {
    
                                // update capacity for specific day and all times
                                editCapacity3($day, $capacity);
                                // redirect to admin's home page
                                echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                            }
                            // if "all days" and actual time were selected
                            else if ($day == "all_days") {
    
                                // update capacity for all days and specific time
                                editCapacity4($time, $capacity);
                                // redirect to admin's home page
                                echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                            }
                            // if actual day and actual time were selected
                            else {
    
                                // update capacity for specific day and specific time
                                editCapacity2($day, $time, $capacity);
                                // redirect to admin's home page
                                echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                            }
                        }
                    }
                }
                ?>
            </div>
    </body>
</html>
