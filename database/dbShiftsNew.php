<?php
/*
 * Functions related to shifts 
 */

include_once(dirname(__FILE__).'/dbinfo.php');

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

function get_availableTimes(){
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
	
    $con=connect();
	$query = "SELECT * FROM dbshiftsnew WHERE day_num = '" . $date . "' AND start_time_value > '". $currentTime ."' UNION SELECT * FROM dbshiftsnew WHERE day_num = '" . $date+1 . "' ORDER BY day_num, start_time_value ASC";
	$results = mysqli_query($con,$query);

    return $results;
}


?>
