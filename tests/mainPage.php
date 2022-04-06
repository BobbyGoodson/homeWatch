<html>
	<head>
		<title>
            Main Page
        </title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
		<style>
			table.main { border-collapse:collapse; font-family:verdana, arial, sans-serif; 
				background: white; width: 100%; margin-left: auto; margin-right: auto; }
			table.main td { border: 1px solid #D3D3D3; font-size:24px; padding:10px; }
			table.main thead {background-color: white; }
			table.main th { border: 1px solid #D3D3D3; font-size:24px; padding:10px; color: #808080; }
			strong { font-size:128px; color:#428BCA; }

            table.top { border-collapse:collapse; font-family:verdana, arial, sans-serif; 
				background: white; width: 100%; margin-left: auto; margin-right: auto; }
			table.top th { border: none; font-size:24px; padding:10px; color: #808080; }
		</style>
	</head>
	<body>
		<?php
    		echo "<br><br><center><strong>Child Care</strong></center><br><br><br>";
		?>
		<?php
		include_once('../database/dbinfo.php');
		include_once('../database/dbShiftsNew.php');


        echo "<table class='top'>
				<tr>
					<th>Date1</th>
					<th>Date2</th>
				</tr>";
        echo "<tr>";

            //FIRST TABLE
            echo "<td>";
            echo "<table class='main'>
				<tr>
					<th>col 1</th>
					<th>col 2</th>
				</tr>";
            $results = get_availableTimes();
            if ($results == NULL){
                echo('No times available.');
            } else {
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
                mysqli_close($con);
            }
            echo "</table>";
            echo "</td>";
            

            


            
            //SECOND TABLE
            echo "<td>";
            echo "<table class='main'>
				<tr>
					<th>col 3</th>
					<th>col 4</th>
				</tr>";
            echo "</table>";
            echo "</td>";

        echo "</tr>";
        echo "</table>";
        /*echo "<table class= 'top'>
                <thead>
					<tr>
					<th>Date1</th>
					<th>Date2</th>
				</thead>
				</tr>";
        
        //TABLE 1
        echo "<td>";
		//get the results by query
		$results = get_availableTimes();

		if ($results == NULL){
			echo('No times available.');
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
				//echo( $row['day']." ".$row['start_time_text']." to ".$end." "."<br>");
				echo "<tr>";
				echo "<td><center>" . $row['start_time_text'] . "-" . $end . "</center></td>";
  				echo "<td><center>" . $openSlots . "</center></td>";
  				echo "</tr>";
			}
			echo "</table>";
            echo "</td>";
            mysqli_close($con);
        }

        //TABLE 2
        echo "<td>";
		//get the results by query
		$results = get_availableTimes();

		if ($results == NULL){
			echo('No times available.');
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
				//echo( $row['day']." ".$row['start_time_text']." to ".$end." "."<br>");
				echo "<tr>";
				echo "<td><center>" . $row['start_time_text'] . "-" . $end . "</center></td>";
  				echo "<td><center>" . $openSlots . "</center></td>";
  				echo "</tr>";
			}
			echo "</table>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
			mysqli_close($con);
        }  */		
		?>
	</body>
</html>