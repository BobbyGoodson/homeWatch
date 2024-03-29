<?php
/*
 * personEdit.php
 * Create new guardian account and update guardian account
 */

session_start();
session_cache_expire(30);
include_once('database/dbPersons.php');
include_once('domain/Person.php');
$id = str_replace("_"," ",$_GET["id"]);


if ($id == 'new') {
    // for creating a new accunt
    // this is creating a starter person object.
    $person = new Person('new', 'applicant', null, null, null, null, null, null);
} else {
    // for editting an account
    $id = $_SESSION['_id'];
    $person = retrieve_person($id);
    if (!$person) { 
        echo('<p id="error">Error: unable to retrieve account information.</p>' . $id);
        die();
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
    </head>
    <body id="bodyForm">
            <div id="formPerson">
                <?PHP
                include('personValidate.inc');
                if ($_POST['_submit_check'] != 1){
                    //in this case, the form has not been submitted, so show it
                    if ($person->get_first_name()=="new"){
                        include('personForm.inc');
                    } else {
                        include('personEditAccount.inc');
                    }
                } else {
                    //FIRST: check if one of the additional buttons were clicked :
                    //1. cancel button - go back to their main page
                    if (isset($_POST['cancel_button'])){
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                    //2. add child button - go to child form
                    if (isset($_POST['addChild_button'])){
                        echo "<script type=\"text/javascript\">window.location = \"childEdit.php?"  . $_SESSION['_id'] . "\";</script>";
                        
                    }


                    //SECOND: validate the form
                    //in this case, the form has been submitted, so validate it
                    $errors = validate_form($person);  //step one is validation.
                    // errors array lists problems on the form submitted
                    if ($errors) {
                        // display the errors and the form to fix
                        show_errors($errors);
                        if ($person->get_first_name()=="new"){
                            include('personForm.inc');
                        } else {
                            include('personEditAccount.inc');
                        }
                        die();
                    }
                    // LASTLY: this was a successful form submission; update the database and exit
                    else
                        process_form($id,$person);
                }

                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_form($id,$person) {
                    //Process the form
                    $first_name = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['first_name']))));
                    $last_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['last_name'])));
                    $phone = trim(str_replace(' ', '', htmlentities($_POST['phone'])));
                    $password = $_POST['password'];
                    $email = $_SESSION['emailaddress'];
                    $position = 'guardian';
                    $barcode = trim(str_replace('\\\'', '\'', htmlentities($_POST['barcode'])));
                    $venue = null;
    
                    if($person->get_first_name()=="new") {
                        // try to add a new person to the database
                        $id = $email;

                        //check if there's already an entry
                        $dup = retrieve_person($id);
                        if ($dup)
                            echo('<p class="error">Error: Unable to create an account. ' . 'The email address "' . $email . '" is already in use.');
                        else {
                            //making the account
                            $newperson = new Person($first_name, $last_name, $phone, $barcode, $email, $position, $password, $venue);
                            $result = add_person($newperson);

                            // redirect to login page
                            echo "<script type=\"text/javascript\">window.location = \"login_form.php\";</script>";
                            }
                    } else {
                        //try to update a person in the database
                        //confirm previous password

                        if ($person->get_password() == $_POST['passwordConfirm']){
                            $person->set_first_name($first_name);
                            $person->set_last_name($last_name);
                            $person->set_phone($phone);
                            $person->set_barcode($barcode);
                            $person->set_password($password);

                            //remove from database
                            remove_person($id);

                            //add the new updated account
                            add_person($person);
                        }

                        //reinitiate this page, so we may stay on this page after updating
                        echo "<script type=\"text/javascript\">window.location = \"personEdit.php?" . $_SESSION['_id'] . "\";</script>";
                    }
                }
                ?>
            </div>
    </body>
</html>