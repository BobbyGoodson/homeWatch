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
    		echo "<br><center><strong>Reserved Child List</strong></center></br>";
		?>
		<?php
		include_once('database/dbShiftsNew.php');
        include_once('database/dbChildren_in_shifts.php');
        include_once('database/dbPersons.php');
        include_once('database/dbChildren.php');

		//get the results by query
		$results = getall_currently_reserved();

		if ($results == NULL){
			echo('<center>No one has reserved a time slot at this time.</center>');

		} else {
			echo "<table class='main'>
				<thead>
					<tr>
					<th>First Name</th>
					<th>Last name</th>
					<th>Day</th>
                    <th>Time</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Health Requirements</th>
				</thead>
				</tr>";
	
			while($row = $results->fetch_assoc()){
                //get the info of child: first_name, last_name, and email
                $childInfo = array();
                $childInfo = explode("*", $row['child_id']);
                $first_name = $childInfo[0];
                $last_name = $childInfo[1];
                $email = $childInfo[2];

                //get health requirements
                $health = get_health_requirements($row['child_id']);

                //get phone number
                $phone = get_phone($email);
				$formatted_phone = phone_edit($phone);

                //get times
                $start = start_time($row['shifts_start_time']);
                $end = end_time($start);

                $day = day($row['shifts_day']);

                //now list them
				echo "<tr>";
				echo "<td><center>" . $first_name . "</center></td>";
				echo "<td><center>" . $last_name . "</center></td>";
  				echo "<td><center>" . $day . "</center></td>";
                echo "<td><center>" . $start . "-" . $end . "</center></td>";
                echo "<td><center>" . $formatted_phone . "</center></td>";
                echo "<td><center>" . $email. "</center></td>";
                echo "<td><center>" . $health . "</center></td>";
                echo "</tr>";
			}
			echo "</table>";	
		}	
		?>
	</body>
</html>