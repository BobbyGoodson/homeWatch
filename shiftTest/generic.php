<?php

	include_once('dbinfo.php');

	//function that returns the time a shift ends
	function end_time($start){
		$end = new DateTime($start);
		$end->modify("+2 hours");
		$end = $end->format('g:iA');
		return $end;	
	}


			

	$con=connect();
	echo("//PRINT ALL SHIFTS FOR MONDAY//<br>");
	$query = "SELECT * FROM dbshiftsnew WHERE day = 'Monday' ORDER BY start_time_value ASC";
	$results = mysqli_query($con,$query);	
	while($row = $results->fetch_assoc()){
		$start = $row['start_time_text'];
		if($start == "5:30PM"){
			break;
		}
		$end = end_time($start);		
		echo( $row['day']." ".$row['start_time_text']." to ".$end." "."<br>");
	}
	mysqli_close($con);			
?>