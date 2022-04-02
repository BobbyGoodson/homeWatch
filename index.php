<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
session_start();
session_cache_expire(30);
?>
<html>
    <head>
        <title>
            RMH Homebase
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>
        	#appLink:visited {
        		color: gray; 
        	}
        </style> 
    </head>
    <body>
        <div id="container">
            <?PHP include('header.php'); ?>
            <div id="content">
                <?PHP
                include_once('database/dbPersons.php');
                include_once('domain/Person.php');
                include_once('domain/Shift.php');
                include_once('database/dbShifts.php');
                date_default_timezone_set('America/New_York');

                //If they aren't logged in, display our homepage with create account and login buttons
                //Else, they are logged in so display their appropriate dashboard according to their position
                if (!isset($_SESSION['logged_in'])) {
                    include('mainPage.php');
                }
                else {
                    /*if ($_SESSION['_id'] != "") {
                    $person = retrieve_person($_SESSION['_id']);
                    echo "<p>Welcome, " . $person->get_first_name() . ", to Homebase!";
                    echo "   You are a " . $person->get_position() . " and this is your homepage.";
                    echo "<p>Today is " . date('l F j, Y') . ".</p>";
                    }*/
                    if ($_SESSION['access_level'] == 0){
                        //Guardian Dashboard
                        include('guardianPage.php');
                    } else if ($_SESSION['access_level'] == 1){
                        //Watcher Dashboard
                        echo('watcher');
                        //include('watcherPage.php');
                    } else if ($_SESSION['access_level'] == 2){
                        //Admin Dashboard
                        echo('admin');
                        //include('watcherPage.php');
                    } else {
                        echo('Something went wrong.');
                    }
                }
                ?>

                <!-- your main page data goes here. This is the place to enter content -->
                <p>
                    <?PHP
                    /*if ($_SESSION['_id'] != "" && $_SESSION['access_level'] >= 0)
                        echo('<p></br> Use the toolbar above to navigate your account.');
                    if ($person) {
                        //Check type of person, and display home page based on that.

                        //DEFAULT PASSWORD CHECK
                        if (md5($person->get_id()) == $person->get_password()) {
                            if (!isset($_POST['_rp_submitted']))
                                echo('<p><div class="warning"><form method="post"><p><strong>We recommend that you change your password, which is currently default.</strong><table class="warningTable"><tr><td class="warningTable">Old Password:</td><td class="warningTable"><input type="password" name="_rp_old"></td></tr><tr><td class="warningTable">New password</td><td class="warningTable"><input type="password" name="_rp_newa"></td></tr><tr><td class="warningTable">New password<br />(confirm)</td><td class="warningTable"><input type="password" name="_rp_newb"></td></tr><tr><td colspan="2" align="right" class="warningTable"><input type="hidden" name="_rp_submitted" value="1"><input type="submit" value="Change Password"></td></tr></table></p></form></div>');
                            else {
                                //they've submitted
                                if (($_POST['_rp_newa'] != $_POST['_rp_newb']) || (!$_POST['_rp_newa']))
                                    echo('<div class="warning"><form method="post"><p>Error with new password. Ensure passwords match.</p><br /><table class="warningTable"><tr><td class="warningTable">Old Password:</td><td class="warningTable"><input type="password" name="_rp_old"></td></tr><tr><td class="warningTable">New password</td><td class="warningTable"><input type="password" name="_rp_newa"></td></tr><tr><td class="warningTable">New password<br />(confirm)</td><td class="warningTable"><input type="password" name="_rp_newb"></td></tr><tr><td colspan="2" align="center" class="warningTable"><input type="hidden" name="_rp_submitted" value="1"><input type="submit" value="Change Password"></form></td></tr></table></div>');
                                else if (md5($_POST['_rp_old']) != $person->get_password())
                                    echo('<div class="warning"><form method="post"><p>Error with old password.</p><br /><table class="warningTable"><tr><td class="warningTable">Old Password:</td><td class="warningTable"><input type="password" name="_rp_old"></td></tr><tr><td class="warningTable">New password</td><td class="warningTable"><input type="password" name="_rp_newa"></td></tr><tr><td class="warningTable">New password<br />(confirm)</td><td class="warningTable"><input type="password" name="_rp_newb"></td></tr><tr><td colspan="2" align="center" class="warningTable"><input type="hidden" name="_rp_submitted" value="1"><input type="submit" value="Change Password"></form></td></tr></table></div>');
                                else if ((md5($_POST['_rp_old']) == $person->get_password()) && ($_POST['_rp_newa'] == $_POST['_rp_newb'])) {
                                    $newPass = md5($_POST['_rp_newa']);
                                    change_password($person->get_id(), $newPass);
                                }
                            }
                            echo('<br clear="all">');
                        }
                    }*/
                    ?>
                </div>
        </div>
    </body>
</html>