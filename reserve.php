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

        $day = intval($_GET['day_num']);
        $time = intval($_GET['time']);
        //$reserveAttempt = increment_reserved($num_children, $day, $time);
        $reserveAttempt = increment_reserved(1, $day, $time);

        if ($reserveAttempt == false){
            echo('failed');
        }

        header("Location: http://localhost/homeWatch/index.php");
        ?>
	</body>
</html>