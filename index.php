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
                date_default_timezone_set('America/New_York');

                //If they aren't logged in, display our homepage with create account and login buttons
                //Else, they are logged in so display their appropriate dashboard according to their position
                if (!isset($_SESSION['logged_in'])) {
                    include('mainPage.php');
                }
                else {
                    if ($_SESSION['access_level'] == 0){
                        //Guardian Dashboard
                        include('guardianPage.php');
                    } else if ($_SESSION['access_level'] == 1){
                        //Watcher Dashboard
                        include('watcherPage.php');
                    } else if ($_SESSION['access_level'] == 2){
                        //Admin Dashboard
                        echo('admin');
                        //include('adminPage.php');
                    } else {
                        echo('Something went wrong.');
                    }
                }
                ?>                
        </div>
    </body>
</html>