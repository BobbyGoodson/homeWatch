<?php
/*
 * List the guardian's current reservations
 * 
 */
session_start();
session_cache_expire(30);
?>

<html>
	<head>
		<title>
            Current Reservations
        </title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
		<style>
			table.main { border-collapse:collapse; font-family:verdana, arial, sans-serif; 
				background: white; width: 65%; margin-left: auto; margin-right: auto; }
			table.main td { border: 1px solid #D3D3D3; font-size:24px; padding:10px; }
			table.main thead {background-color: white; }
			table.main th { border: 1px solid #D3D3D3; font-size:24px; padding:10px; color: #808080; }
		</style>
	</head>
	<body>
    <?PHP include('header.php'); ?>
		<?php
    	echo "<br><center><strong>Current Reservations</strong></center></br>";

		include_once('database/dbShiftsNew.php');
        include_once('database/dbChildren_in_shifts.php');
        include_once('database/dbChildren.php');

		//get the children attached to the account
        $children_id = array();
        $children_id = retrieve_child_by_email($_SESSION['_id']);

        if (count($children_id) != 0){
            echo '<table align = "center" class = "main">';
			    echo '<tr>';
			        echo '<th>First Name</th>';
			        echo '<th>Last Name</th>';
			        echo '<th>Shift</th>';
                    echo '<th>Cancellation</th>';
		        echo '</tr>';
            foreach ($children_id as $child_id){
                //We have children, now check if they are in any are currently reserved
                $result =  get_child_reservation($child_id);
		        if ($result != false) {
                    //Get neccessary information
                    //get the info of child: first_name and last_name 
                    $childInfo = array();
                    $childInfo = explode("*", $result['child_id']);
                    $first_name = $childInfo[0];
                    $last_name = $childInfo[1];

                    //get readable start and end times
                    $start = start_time($result['shifts_start_time']);
                    $end = end_time($start);

                    //get the day
                    $day = day($result['shifts_day']);

				    echo '<tr>';
				    echo '<td><center>' . $first_name . '</center></td>';
                    echo '<td><center>' . $last_name . '</center></td>';
                    echo '<td><center>' . $day . ', ' . $start . '-' . $end . '</center></td>';
                    echo '<td><center><a style="font-weight:bold; color: #428BCA; font-size: 24px; width:100%; " href="reserveCancel.php?id=' . $result['child_id'] . '&shift_start=' . $result['shifts_start_time'] . '&day_num=' . $result['shifts_day'] . '"">Cancel</a></center></td>';
                    echo '</tr>';
			    } else {
                    // echo('<center>You have no current reservatiosn at this time</center>');
                    continue;
                }
            }
            echo'</table>';
        } else {
            echo('<center>You have no children added to your account.</center>');
        }
		?>
	</body>
</html>