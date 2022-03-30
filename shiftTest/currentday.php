<?php

	include_once('dbinfo.php');

	//function that returns the time a shift ends
	function end_time($start){
		$end = new DateTime($start);
		$end->modify("+2 hours");
		$end = $end->format('g:iA');
		return $end;	
	}


			
	//TEST OF PRINTING the slots for the current day

	//set time zone
	date_default_timezone_set('America/Richmond');
	//get the current day of the week (this is returned as a number with Monday being 1 Tuesday being 2 ect
	$date = date('w');


	//connect to database and make query
	$con=connect();
	$query = "SELECT * FROM dbshiftsnew WHERE day_num = '" . $date . "' ORDER BY start_time_value ASC";
	$results = mysqli_query($con,$query);

	//object returned from database must be iterated through row by row to print.	
	while($row = $results->fetch_assoc()){
		$start = $row['start_time_text'];
		//this if statement prevents the program from showing shifts starting later than the 2 hour cuttoff
		if($start == "5:30PM"){
			break;
		}
		$end = end_time($start);		
		echo( $row['day']." ".$row['start_time_text']." to ".$end." "."<br>");
	}
	mysqli_close($con);			
?>