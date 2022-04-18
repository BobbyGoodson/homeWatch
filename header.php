<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHP-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */
session_start();
session_cache_expire(30);
?>
<!-- Begin Header -->
<style type="text/css">
    table.header{width:100%; border:none; font-family:verdana, arial, sans-serif; }
    table.header tr,td{font-size:24px; padding:3px; }
</style>
<div id="header">
</div>


<div align="center" id="navigationLinks">

    <?PHP
    //Log-in security
    //If they aren't logged in, display our homepage with create account and login buttons
    if (!isset($_SESSION['logged_in'])) {

        // align logo to top left
        echo('<table class="header"><tr><td><div align = "left"><img src="images/YMCAlogo.png" width="150" height="100"></div></td><td>');
        echo('<div align = "right">');
        echo('<a href="' . $path . 'emailAuthentication.php">Create Account</a>');
        echo('<a href="' . $path . 'login_form.php">Login</a>');
        echo('</div></td></tr></table>');
    } else if ($_SESSION['logged_in']) {

        /*         * Set our permission array.
         * anything a guest can do, a volunteer and manager can also do
         * anything a volunteer can do, a manager can do.
         *
         * If a page is not specified in the permission array, anyone logged into the system
         * can view it. If someone logged into the system attempts to access a page above their
         * permission level, they will be sent back to the home page.
         */

        // pages guardians can view
        $permission_array['index.php'] = 0;
        $permission_array['viewSchedule.php'] = 0;
        $permission_array['personSearch.php'] = 0;
        $permission_array['personEdit.php'] = 0;
        $permission_array['about.php'] = 0;

        // pages watchers can view
        // everything guardians can view

        // pages only admin can view
        // everything guardians and watchers can view
        $permission_array['listGuardians.php'] = 2;
        $permission_array['listChildren.php'] = 2;
        $permission_array['reports.php'] = 2;

        //Check if they're at a valid page for their access level.
        $current_page = strtolower(substr($_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'],"/")+1));
        $current_page = substr($current_page, strpos($current_page,"/")+1);
        
        if($permission_array[$current_page]>$_SESSION['access_level']){
            //in this case, the user doesn't have permission to view this page.
            //we redirect them to the index page.
            echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
            //note: if javascript is disabled for a user's browser, it would still show the page.
            //so we die().
            die();
        }
        
        // align logo to top left
        echo('<table class="header"><tr><td><div align = "left"><img src="images/YMCAlogo.png" width="150" height="100"></div></td><td>');
        echo('<div align = "right">');

        if ($_SESSION['access_level'] == 0) {
            echo(' <a href="' . $path . 'index.php">Availability</a>');
            echo(' <a href="' . $path . 'guardianReservationList.php">Current Reservations</a>');
            echo(' <a href="' . $path . 'personEdit.php?id=' . $_SESSION['_id'] . '">Update Account</a>');
            echo(' <a href="' . $path . 'about.php">About</a>');
	    }
	    else if ($_SESSION['access_level'] == 1) {
	        echo(' <a href="' . $path . 'index.php">Availability</a>');
            echo(' <a href="' . $path . 'reserveChildList.php">Current Reservations</a>');
	    }
        else if ($_SESSION['access_level'] == 2) {
	        echo(' <a href="' . $path . 'index.php">Availability</a>');
            echo(' <a href="' . $path . 'reserveChildList.php">Current Reservations</a>');
            echo(' <a href="' . $path . 'adminEdit.php">Create Admin Account</a>');
            echo(' <a href="' . $path . 'watcherEdit.php">Create Watcher Account</a>');
            echo(' <a href="' . $path . 'listGuardians.php">Guardians</a>');
            echo(' <a href="' . $path . 'alterCapacity.php">Update Capacity</a>');
        }
            
	    echo(' <a href="' . $path . 'logout.php">Logout</a><br>');  
        echo('</div></td></tr></table>');
    }
    ?>
</div>
<!-- End Header -->