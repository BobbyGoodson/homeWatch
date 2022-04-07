<?php
/*
 * Make a Reservation
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
        include_once('database/dbChildren.php');
        include_once('database/dbChildren_in_shifts.php');

        $_SESSION['reserve_error'] = null;
        $error = 0;

        /*
         * First, retrieve the children IDs attached to this guardian account
        */
        $children_id = array();
        $children_id = retrieve_child_by_email($_SESSION['_id']); //used to attach to the children_in_slots table
        $num_children = count($children_id); //used to decrement the reserved slots
        if ($num_children == 0){
            $_SESSION['reserve_error'] = "You must add children to your account to reserve a time slot. You can do add children in the 'Update Account' tab above.";
            $error = 1;
            header("Location: http://localhost/homeWatch/index.php");
        }


        /*
         * Second, check if one of the children have been in a reserved space. Send an error message.
        */
        foreach ($children_id as $child){
            $result = check_if_child_reserved($child);
            if ($result == true){
                $_SESSION['reserve_error'] = "A child has already been reserved";
                $error = 1;
                header("Location: http://localhost/homeWatch/index.php");
            }
        }

        if ($error == 0){
            /*
            * Third, deal with the reserved spaces: check if there is enough space for the number of children
            */
            $day = intval($_GET['day_num']);
            $time = intval($_GET['time']);
            $venue = $_GET['venue'];
            $reserveAttempt = increment_reserved($num_children, $day, $time, $venue);

            if ($reserveAttempt == false){
                //lets send some error message about not having enough space
                $end = end_time($_GET['frame']);
                $_SESSION['reserve_error'] = "Not enough space for " . $num_children . " children for the time slot: " . $_GET['day'] . ", " . $_GET['frame'] . "-" . $end . "at the " . $venue . " location";
            } else {
                /*
                * Fourth, put these children along with the chosen time slot into the children_in_slots table
                */
                foreach ($children_id as $child){
                    $result = add_entry($child, $day, $time);
                    if ($result == false){
                        $_SESSION['reserve_error'] = "Could not add " . $child . "";
                    }
                }
            }
        }
        header("Location: http://localhost/homeWatch/index.php");
        ?>
	</body>
</html>