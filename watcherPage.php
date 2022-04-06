<html>
	<head>
		<title>
            Main Page
        </title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
		<style>
			table.main { border-collapse:collapse; font-family:verdana, arial, sans-serif; 
				background: white; width: 65%; margin-left: auto; margin-right: auto; }
			table.main td { border: 1px solid #D3D3D3; font-size:24px; padding:10px; }
			table.main thead {background-color: white; }
			table.main th { border: 1px solid #D3D3D3; font-size:24px; padding:10px; color: #808080; }
			strong { font-size:128px; color:#428BCA; }
		</style>
	</head>
	<body>
		<?php
    		echo "<br><br><center><strong>Child Care</strong></center><br><br><br>";

            if ($_SESSION['reserve_error'] != null){
                echo("<center><font color=\"red\">" . "*" . $_SESSION['reserve_error'] . "</font></center>\n");
            }
		?>
		<?php
		include_once('database/dbShiftsNew.php');

		//get the results by query
		$results = get_availableTimes();

		if ($results == NULL){
			echo('No times available.');

		} else {

			echo "<table class='main'>
				<thead>
					<tr>
					<th>Date</th>
					<th>Time Slots</th>
					<th>Availability</th>
                    <th>Reserve Slot</th>
				</thead>
				</tr>";

			//object returned from database must be iterated through row by row to print.	
			while($row = $results->fetch_assoc()){
				$start = $row['start_time_text'];
				//this if statement prevents the program from showing shifts starting later than the 2 hour cuttoff
				/*if($start == "5:30PM"){
					break;
				}*/

				//if there is no available slots, do not show
				$openSlots = slots_open($row);
				if ($openSlots == 0){
					continue;
				}

                $date= date("m/d", strtotime($row['day']));

				$end = end_time($start);		
				//echo( $row['day']." ".$row['start_time_text']." to ".$end." "."<br>");
				echo "<tr>";
				echo "<td><center>" . $row['day'] . ", " . $date . "</center></td>";
				echo "<td><center>" . $row['start_time_text'] . "-" . $end . "</center></td>";
  				echo "<td><center>" . $openSlots . "</center></td>";
                echo '<td><center><a style="font-weight:bold; color: #428BCA; font-size: 24px; width:100%; " href="drop_in.php?day_num=' . $row['day_num'] . '&time=' . $row['start_time_value'] . '&date=' . $date . '&venue=' . $row['venue'] . '&start=' . $row['start_time_text'] . '&end=' . $end . '">Reserve</a></center></td>';
                //echo "<td><div style= 'text-align:center'><input type='submit' value='Reserve' name='" . $row['day'] . "'.'" . $row['start_time_text'] . "'></div></td>";
                echo "</tr>";
			}
			echo "</table>";	
		}	
		?>
	</body>
</html>