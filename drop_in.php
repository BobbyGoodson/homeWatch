<?php
/*
 * 	drop_in.php
 *  Adds walk-ins 
 */
session_start();
session_cache_expire(30);

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
                //include('dropinValidate.inc');
                //let's get some information about the time slot, taken from the url
                $end = $_GET['end'];
                $start = $_GET['start'];
                $date = $_GET['date'];
		//and the information we need from POST
		$email = $_POST['email'];
		$c_first_name =  $_POST['c_first_name'];
		$c_last_name =  $_POST['c_last_name'];
		$c_DOB =  $_POST['c_DOB'];
		$health_requirements =  $_POST['health_requirements'];
		
		//includes
                include('personValidate.inc');
		include_once('database/dbinfo.php');
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
                            process_dropin($c_first_name,$c_last_name,$c_DOB,$health_requirements,$email,$start,$date);
                            //go back
                            echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                        }
                    }
                }
                
                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_dropin($c_first_name,$c_last_name,$c_DOB,$health_requirements,$email,$start,$date) {
                    //Process the form
			$id = $c_first_name . "*" . $c_last_name . "*" . $email;
			$con=connect();
			mysqli_query($con,'INSERT INTO dbChildren VALUES("' .
                		$id . '","' .
               			$c_first_name . '","' .
                		$c_last_name . '","' .
                		$c_DOB . '","' .
                		$health_requirements . '","' .
                		$email .
                		'");');	
			mysqli_close($con);
			
		
                    //check if enough room, etc.
                    echo('hey');
                }
                ?>
            </div>
    </body>
</html>
