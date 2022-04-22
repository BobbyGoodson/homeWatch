<?php
/*
 * mainPage.php
 * Main page
 */
?>
<html>
	<head>
		<title>
            Main Page
        </title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
		<style>
			table.main { border-collapse:collapse; font-family:verdana, arial, sans-serif; 
				background: white; width: 100%; }
			table.main td { border: 1px solid #D3D3D3; font-size:24px; padding:10px; }
			table.main th { border: 1px solid #D3D3D3; font-size:24px; padding:10px; color: #808080; }
			strong { font-size:128px; color:#428BCA; }

            table.top { border-collapse:collapse; font-family:verdana, arial, sans-serif; 
				background: white; width: 80%; margin-left: auto; margin-right: auto; }
			table.top th { border: none; font-size:24px; padding:10px; color: #808080; }
			table.top tr{vertical-align: top;}
		</style>
	</head>
	<body>
		<?php
    		echo "<br><br><center><strong>Child Care</strong></center><br><br><br>";
		?>
		<?php
		include_once('database/dbinfo.php');
		include_once('database/dbShiftsNew.php');

		date_default_timezone_set("America/New_York");
		$today = day(date('w'));
		$tomorrow = day(date('w', strtotime('tomorrow')));

        echo "<table class='top'>
				<tr>
					<th><center>" . $today . ", " . date('m/d') . "</center></th>
					<th><center>" . $tomorrow . ", " . date('m/d', strtotime('tomorrow')) . "</center></th>
				</tr>
				<tr>";
					//FIRST TABLE
					echo "<td>";
					//get the results by query
					$results = get_availableTimes_wday($today);

					if ($results == false){
						echo('<center>No times available.</center>');
					} else {
						echo "<table class='main'>
							<tr>
							<th>Time Slots</th>
							<th>Availability</th>
							</tr>";

						//object returned from database must be iterated through row by row to print.	
						while($row = $results->fetch_assoc()){
							$start = $row['start_time_text'];

							//if there is no available slots, do not show
							$openSlots = slots_open($row);
							if ($openSlots == 0){
								continue;
							}

							$end = end_time($start);		
							echo "<tr>";
							echo "<td><center>" . $row['start_time_text'] . "-" . $end . "</center></td>";
			  				echo "<td><center>" . $openSlots . "</center></td>";
			  				echo "</tr>";
						}
						echo "</table>";
			            echo "</td>";
			        }
					echo "</td>";

					//SECOND TABLE
					echo "<td>";
					//get the results by query
					$results = get_availableTimes_wday_allday($tomorrow);

					if ($results == false){
						echo('<center>No times available.</center>');
					} else {
						echo "<table class='main'>
							<tr>
							<th>Time Slots</th>
							<th>Availability</th>
							</tr>";

						//object returned from database must be iterated through row by row to print.	
						while($row = $results->fetch_assoc()){
							$start = $row['start_time_text'];

							//if there is no available slots, do not show
							$openSlots = slots_open($row);
							if ($openSlots == 0){
								continue;
							}

							$end = end_time($start);		
							echo "<tr VALIGN=TOP>";
							echo "<td><center>" . $row['start_time_text'] . "-" . $end . "</center></td>";
			  				echo "<td><center>" . $openSlots . "</center></td>";
			  				echo "</tr>";
						}
						echo "</table>";
			            echo "</td>";
			        }

					echo "</td>";
				echo "</tr>";
        echo "<tr>";		
		?>
	</body>
</html>