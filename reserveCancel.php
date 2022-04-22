<?php
/*
 * reserveCancel.php
 * Cancel Reservation
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
        include_once('database/dbChildren_in_shifts.php');

        if(!isset($_SESSION['_id'])){
            echo ('page unavailable');
        } else {
            //get the information from last page
            $child_id = $_GET['id'];
            $start_time = $_GET['shift_start'];
            $day_num = $_GET['day_num'];

            /*
            * First, take them off children_in_shifts table
            */
            remove_reservation($child_id, $start_time);

            /*
            * Second, Increment the four time slots they used to occupy in shifts table
            */
            decrement_reserved(1, $day_num, $start_time);
        
            //go back to the reservation page
            if ($_SESSION['access_level'] == 0){
                header("Location: http://localhost/homeWatch/guardianReservationList.php");
            } else {
                header("Location: http://localhost/homeWatch/reserveChildList.php");
            }
        }
        ?>
	</body>
</html>