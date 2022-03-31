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
		?>
		<?php
		include_once('database/dbinfo.php');

		//function that returns the time a shift ends
		function end_time($start){
			$end = new DateTime($start);
			$end->modify("+2 hours");
			$end = $end->format('g:iA');
			return $end;	
		}

		//function that takes a start shift and checks how many slots are open. $row is a single row from an sql result
		function slots_open($row){
			$openSlots = 1000000;
			$con=connect();
			$current = $row['start_time_value'];
			$count = 0;
			//iterate through by 30 minutes
			while($count < 4){
			
				$query = "SELECT * FROM dbshiftsnew WHERE day_num = '" . $row['day_num'] . "' AND start_time_value = '" . $current . "' ORDER BY start_time_value ASC";
				$results = mysqli_query($con,$query);
				$current += 0.5;
				$count += 1;
				//this doesn't need to be a loop because it is only one row, I just need to figure out how to do it without one in php
				while($currentrow = $results->fetch_assoc()){
					$cap = $currentrow['capacity'];
					$reserved = $currentrow['reserved'];
					if( $cap == $reserved ){
						$openSlots = 0;
						mysqli_close($con);
						return $openSlots;
					}
					else if( ($cap - $reserved) < $openSlots){
						$openSlots = $cap - $reserved;
					}
				}
			}
		//returns the lowest number of open slots found at the end
		mysqli_close($con);
		return $openSlots;
	}
	
		//TEST OF PRINTING the slots for the current day

		//set time zone
		date_default_timezone_set('America/New_York');
		//get the current day of the week (this is returned as a number with Monday being 1 Tuesday being 2 ect
		$date = date('w');

		//get time
		$minute = date('i');
		if ($minute > 30){
			$minute = 55;
		}
		$hour = date('H');
		$currentTime = $hour . "." . $minute;
		//echo($currentTime);

		//connect to database and make query
		$con=connect();
		$query = "SELECT * FROM dbshiftsnew WHERE day_num = '" . $date . "' AND start_time_value > '". $currentTime ."' UNION SELECT * FROM dbshiftsnew WHERE day_num = '" . $date+1 . "' ORDER BY day_num, start_time_value ASC";
		$results = mysqli_query($con,$query);
		if ($results == NULL){
			echo('No times available.');

		} else {

			echo "<table class='main'>
				<thead>
					<tr>
					<th>Date</th>
					<th>Time Slots</th>
					<th>Availability</th>
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

				$end = end_time($start);		
				//echo( $row['day']." ".$row['start_time_text']." to ".$end." "."<br>");
				echo "<tr>";
				echo "<td><center>" . $row['day'] . " " . date("m/d") . "</center></td>";
				echo "<td><center>" . $row['start_time_text'] . "-" . $end . "</center></td>";
  				echo "<td><center>" . $openSlots . "</center></td>";
  				echo "</tr>";
			}
			echo "</table>";
			mysqli_close($con);		
		}	
		?>
	</body>
</html>