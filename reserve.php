<?php
/*
 * 
 */

session_start();
session_cache_expire(30);
?>
<html>
    <head>
        <title>
            Reserving time slot...
        </title>
    </head>
    <body>
        <?php
        include_once('database/dbShiftsNew.php');
        //First, retrieve the children attached to this account



        //Second, deal with the reserved spaces: check if there is enough space for the number of children
        $day = intval($_GET['day_num']);
        $time = intval($_GET['time']);
        $reserveAttempt = increment_reserved(1, $day, $time);

        if ($reserveAttempt == false){
            echo('failed');
        }

        //Third, put these children along with the chosen time slot into the children_in_slots table

        

        header("Location: http://localhost/homeWatch/index.php");
        ?>
	</body>
</html>