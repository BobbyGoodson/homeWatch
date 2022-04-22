<?php
/*
 * login_form.php
 * Login Page
 */

session_start();
session_cache_expire(30);
?>
<html>
    <head>
        <title>
            Login
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
    </head>
<body id="bodyForm">
<div id="container">
<div id="form">
    <?PHP
    include_once('database/dbPersons.php');
    include_once('domain/Person.php');
    if (($_SERVER['PHP_SELF']) == "/logout.php") {
        //prevents infinite loop of logging in to the page which logs you out...
        echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
    }
    if (!array_key_exists('_submit_check', $_POST)) {
        echo('<p><img src="images/YMCAlogo.png" width="200" height="150"></p>
                <p><table style="text-align:center" class="form"><form method="post"><input type="hidden" name="_submit_check" value="true">
                <tr><td><input type="text" name="user" placeholder="Email" tabindex="1"><br /><br /></td></tr>
        		<tr><td><input type="password" name="pass" placeholder="Password"tabindex="2"><br /><br /></td></tr>
                <tr><td colspan="2"><input type="submit" name="Login" value="Login"><br /><br /></td></tr>
                <tr><td>Forgot your password?<a href="' . $path . 'forgetPasswordEmailAuthentication.php">Reset it.</a><br /><br /></td></tr>
                <tr><td>Don\'t have an account?<a href="' . $path . 'emailAuthentication.php">Sign up for one!</a></td></tr></table></p>');
    } else {

        // if either field is left blank
        if ($_POST['user'] == "" || $_POST['pass'] == "") {

            // show error message
            echo('<div align="center"><p class="error">Error: Didn\'t fill in all of the required fields.<br />');
            echo('<p><strong>Login</strong></p>
                    <p><table style="text-align:center" class="form"><form method="post"><input type="hidden" name="_submit_check" value="true">
                    <tr><td><input type="text" name="user" placeholder="Email" tabindex="1"><br /><br /></td></tr>
                    <tr><td><input type="password" name="pass" placeholder="Password"tabindex="2"><br /><br /></td></tr>
                    <tr><td colspan="2"><input type="submit" name="Login" value="Login"><br /><br /></td></tr>
                    <tr><td>Forgot your password?<a href="' . $path . 'forgetPasswordEmailAuthentication.php">Reset it.</a><br /><br /></td></tr>
                    <tr><td>Don\'t have an account?<a href="' . $path . 'emailAuthentication.php">Sign up for one!</a></td></tr></table></p>');
        }
        //otherwise authenticate their password
        else {
            //$db_pass = md5($_POST['pass']);
            $db_pass = $_POST['pass'];
            $db_id = $_POST['user'];
            $person = retrieve_person($db_id);
            if ($person) { //avoids null results
                if ($person->get_password() == $db_pass) { //if the passwords match, login
                    $_SESSION['logged_in'] = 1;
                    date_default_timezone_set ("America/New_York");
                    
                    // if position of person logging in is "admin"
                    if ($person->get_position() == "admin")
                        // set access level to 2
                        $_SESSION['access_level'] = 2;
                    // if position of person logging in is "watcher"    
                    else if ($person->get_position() == "watcher")
                        // set access level to 1
                        $_SESSION['access_level'] = 1;
                    // if position of person logging in is "guardian"
                    else if ($person->get_position() == "guardian")
                        // set access level to 0
                        $_SESSION['access_level'] = 0;
                     
                    $_SESSION['f_name'] = $person->get_first_name();
                    $_SESSION['l_name'] = $person->get_last_name();
                    $_SESSION['_id'] = $_POST['user'];
                    echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
                }
                // wrong password
                else {
                    // error message
                    echo('<div align="center"><p class="error">Error: invalid username/password.<br />If you cannot remember your password, reset your password.');
                    echo('<p><strong>Login</strong></p>
                    <p><table style="text-align:center" class="form"><form method="post"><input type="hidden" name="_submit_check" value="true">
                    <tr><td><input type="text" name="user" placeholder="Email" tabindex="1"><br /><br /></td></tr>
                    <tr><td><input type="password" name="pass" placeholder="Password"tabindex="2"><br /><br /></td></tr>
                    <tr><td colspan="2"><input type="submit" name="Login" value="Login"><br /><br /></td></tr>
                    <tr><td>Forgot your password?<a href="' . $path . 'forgetPasswordEmailAuthentication.php">Reset it.</a><br /><br /></td></tr>
                    <tr><td>Don\'t have an account?<a href="' . $path . 'emailAuthentication.php">Sign up for one!</a></td></tr></table></p>');               
                }
            //At this point, they failed to authenticate
            } else {
                // error message
                echo('<div align="center"><p class="error">Error: invalid username/password.<br />If you cannot remember your password, reset your password.');
                echo('<p><strong>Login</strong></p>
                    <p><table style="text-align:center" class="form"><form method="post"><input type="hidden" name="_submit_check" value="true">
                    <tr><td><input type="text" name="user" placeholder="Email" tabindex="1"><br /><br /></td></tr>
                    <tr><td><input type="password" name="pass" placeholder="Password"tabindex="2"><br /><br /></td></tr>
                    <tr><td colspan="2"><input type="submit" name="Login" value="Login"><br /><br /></td></tr>
                    <tr><td>Forgot your password?<a href="' . $path . 'forgetPasswordEmailAuthentication.php">Reset it.</a><br /><br /></td></tr>
                    <tr><td>Don\'t have an account?<a href="' . $path . 'emailAuthentication.php">Sign up for one!</a></td></tr></table></p>');
            }
        }
    }
    ?>
</div>
</div>
</body>
</html>