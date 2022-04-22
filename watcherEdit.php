<?php
/*
 * watcherEdit.php
 * Adds a new watcher account to the database
 */

session_start();
session_cache_expire(30);
include_once('database/dbPersons.php');
include_once('domain/Person.php');
?>
<html>
    <head>
        <title>
            Creating Watcher Account
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
    </head>
    <body id="bodyForm">
            <div id="formPerson">
                <?PHP
                include('personValidate.inc');
                if ($_POST['_submit_check'] != 1){
                    //in this case, the form has not been submitted, so show it
                    include('watcherForm.inc');
                } else {
                    // if cancel button was clicked - redirect to admin's homepage
                    if (isset($_POST['cancel_button'])){
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                    // else
                    else {
                        // validate watcher form
                        $errors = validate_watcher_admin_form();

                        // errors array lists problems on the form submitted
                        if ($errors) {
                            // display the errors and the form to fix
                            show_errors($errors);
                            include('watcherForm.inc');
                            die();
                        } 
                        // else
                        else {
                            // process form
                            process_form($person);
                        }
                    }
                }

                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_form($person) {

                    //Process the form
                    $first_name = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['first_name']))));
                    $last_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['last_name'])));
                    $phone = trim(str_replace(' ', '', htmlentities($_POST['phone'])));
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $position = 'watcher';
                    $barcode = null;
                    $venue = null;

                    // try to add a new person to the database
                    $id = $email;
                    //check if there's already an entry
                    $dup = retrieve_person($id);
                    if ($dup) {
                        echo('<p class="error">Error: Unable to create a watcher account. ' . 'The email address "' . $email . '" is already in use.');
                        include('watcherForm.inc');
                    }
                    else {
                        //making the account
                        $newperson = new Person($first_name, $last_name, $phone, $barcode, $email, $position, $password, $venue);
                        add_person($newperson);

                        // redirect to admin's homepage
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                }
                ?>
            </div>
    </body>
</html>