<?php
//TEST of adding a child to the database 

	include_once('dbinfo.php');

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
			
	//main

	//set time zone
	date_default_timezone_set('America/New_York');
	//get the current day of the week (this is returned as a number with Monday being 1 Tuesday being 2 ect
	$date = date('w');
	


	//connect to database and make query
	$con=connect();
	$query = "SELECT * FROM dbshiftsnew WHERE day_num = '" . $date . "' ORDER BY start_time_value ASC";
	$results = mysqli_query($con,$query);
	mysqli_close($con);

	//object returned from database must be iterated through row by row to print.	
	while($row = $results->fetch_assoc()){
		$start = $row['start_time_text'];
		//this if statement prevents the program from showing shifts starting later than the 2 hour cuttoff
		if($start == "5:30PM"){
			break;
		}
	
		$end = end_time($start);
		$openSlots = slots_open($row);		
		echo( $row['day']." ".$row['start_time_text']." to ".$end." has ". $openSlots ."<br>");

	}
				
?>