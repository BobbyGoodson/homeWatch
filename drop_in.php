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
                $end = $_GET['start'];
                $start = $_GET['end'];
                $date = $_GET['date'];
                include('personValidate.inc');
                if ($_POST['_submit_dropin'] != 1){
                    //in this case, the form has not been submitted, so show it
                    include('drop_in.inc');
                } else {
                    //validate the form
                    //in this case, the form has been submitted, so validate it
                    $errors = validate_dropin_form();
                    if ($errors) {
                        show_errors($errors);
                        include('drop_in.inc');
                        die();
                    } else {
                        process_dropin();
                        //go back
                        echo "<script type=\"text/javascript\">window.location = \"index.php?"  . $_SESSION['_id'] . "\";</script>";
                    }
                }
                
                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_dropin() {
                    //Process the form
                    //check if enough room, etc.
                    echo('hey');
                }
                ?>
            </div>
    </body>
</html>
