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
            Altering Capacity
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>

        </style>
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
    </head>
    <body id="bodyForm">
            <div id="alterCapacityForm">
                <?PHP
                  
                        if ($_POST['_submit_child'] != 1){
                    //in this case, the form has not been submitted, so show it
                    include('alterCapacityForm.inc');
                     
                } else {
                    
                     if (isset($_POST['cancel_button'])){
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                    if (isset($_POST['add1'])){
                        process_form1();
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                    if (isset($_POST['add2'])){
                        process_form2();
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                    //else
                    else {
                        // validate child form
                        //$errors = validate_child_form();
                        
                        // errors array lists problems on the form submitted
                        //if ($errors) {
                            // display the errors and the form to fix
                            //show_errors($errors);
                            //include('alterCapacityForm.inc');
                            //die();
                        //}
                    }
                }
                 
                 function process_form1() {

                    $v = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['venue']))));;
                  $day_num = trim(str_replace('\\\'', '\'', htmlentities($_POST['day_num'])));;
                  $starT = trim(str_replace('\\\'', '\'', htmlentities($_POST['start_time_value'])));;
                  $cap = trim(str_replace('\\\'', '\'', htmlentities($_POST['capacity'])));;           

                  editCapacity2($v, $day_num, $starT, $cap);
                 
                }
                function process_form2() {

                    $v = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['venue']))));;
                    $cap = trim(str_replace('\\\'', '\'', htmlentities($_POST['capacity'])));;
                    
                      editCapacity($v, $cap);
                  
                }
                
                ?>
            </div>
    </body>
</html>
