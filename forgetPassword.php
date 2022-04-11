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
            Reset Password
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
                    include('forgetPasswordForm.inc');
                } else {
                    // if cancel button was clicked - redirect to homepage
                    if (isset($_POST['cancel_button'])){
                        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                    }
                    // else
                    else {
                        // validate forget password form
                        $errors = validate_forget_password_form();

                        // errors array lists problems on the form submitted
                        if ($errors) {
                            // display the errors and the form to fix
                            show_errors($errors);
                            include('forgetPasswordForm.inc');
                            die();
                        } 
                        // else if both passwords don't match
                        else if ($_POST['password'] != $_POST['passwordConfirm']) {

                            echo('<p align="center" class="error">Error: Those passwords didn\'t match.');
                            include('forgetPasswordForm.inc');
                            die();
                        }
                        // else reset password
                        else {

                            $userEmail = $_SESSION['emailaddress'];
                            $password = $_POST['password'];

                            // change password
                            change_password($userEmail, $password);

                            // redirect to login page
                            echo "<script type=\"text/javascript\">window.location = \"login_form.php\";</script>";
                        }
                    }
                }
                ?>
            </div>
    </body>
</html>