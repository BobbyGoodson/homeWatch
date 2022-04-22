<?php
/*
 * 	childEdit.php
 *  Adds children to database
 */

session_start();
session_cache_expire(30);
include_once('database/dbChildren.php');
include_once('domain/Child.php');
?>
<html>
    <head>
        <title>
            Adding Child
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>

        </style>
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
    </head>
    <body id="bodyForm">
            <div id="formperson">
                <?PHP
                include('personValidate.inc');
                if ($_POST['_submit_child'] != 1){
                    //in this case, the form has not been submitted, so show it
                    include('childForm.inc');
                } else {
                    // if cancel button was clicked - redirect to guardian's update account
                    if (isset($_POST['cancel_button'])){
                        echo "<script type=\"text/javascript\">window.location = \"personEdit.php?"  . $_SESSION['_id'] . "\";</script>";
                    }
                    //else
                    else {
                        // validate child form
                        $errors = validate_child_form();
                        
                        // errors array lists problems on the form submitted
                        if ($errors) {
                            // display the errors and the form to fix
                            show_errors($errors);
                            include('childForm.inc');
                            die();
                        } 
                        // else
                        else {
                            // process form
                            process_child();
                        }
                    }
                }
                
                /**
                 * process_child sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_child() {

                    //Process the form
                    $first_name = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['first_name']))));
                    $last_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['last_name'])));
                    $DOB = trim(str_replace('\\\'', '\'', htmlentities($_POST['DOB'])));
                    $temp_health_requirements = trim($_POST['health_requirements']);
                    $health_requirements = nl2br($temp_health_requirements);
                    $parent_email = $_SESSION['_id'];
			 
                    // child first name saved in session variable to be added to update account page
                    $_SESSION['child_first_name'] = $first_name;

                    $newchild = new Child($first_name, $last_name, $DOB, $health_requirements, $parent_email);
                    add_child($newchild);
                   
                    // redirect to guardian's update account page
                    echo "<script type=\"text/javascript\">window.location = \"personEdit.php?"  . $_SESSION['_id'] . "\";</script>";           
                }
                ?>
            </div>
    </body>
</html>