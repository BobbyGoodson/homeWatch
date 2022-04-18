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

function start_time($start_number){
    $con=connect();
    $query = 'SELECT start_time_text from dbshiftsnew WHERE start_time_value = "' . $start_number . '" LIMIT 1';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    while ($row = mysqli_fetch_assoc($result)) {
        return $row['start_time_text'];
    }
    return false;
}

//get the day in string format from the day number
function day($day_number){
    $con=connect();
    $query = 'SELECT day from dbshiftsnew WHERE day_num = "' . $day_number . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    while ($row = mysqli_fetch_assoc($result)) {
        return $row['day'];
    }
    return false;
}

//get available times froma  specific day
function get_availableTimes_wday($day){
    date_default_timezone_set('America/New_York');
	//get time
	$minute = date('i');
	if ($minute > 30){
		$minute = 55;
	}
	$hour = date('H');
	$currentTime = $hour . "." . $minute;
	
    $con=connect();
	$query = "SELECT * FROM dbshiftsnew WHERE day = '" . $day . "' AND start_time_value > '". $currentTime ."' ORDER BY start_time_value ASC";
	$results = mysqli_query($con,$query);
    mysqli_close($con);
    if (mysqli_num_rows($results) > 0){
        return $results;
    } else {
        return false;
    }
}

//get available times froma  specific day
function get_availableTimes_wday_allday($day){
    $con=connect();
	$query = "SELECT * FROM dbshiftsnew WHERE day = '" . $day . "' ORDER BY start_time_value ASC";
	$results = mysqli_query($con,$query);
    mysqli_close($con);
    if (mysqli_num_rows($results) > 0){
        return $results;
    } else {
        return false;
    }
}

function editCapacity($venue, $capacity){
    $con=connect();
    //$query = 'UPDATE dbshiftsnew SET capacity = '" . $capacity . "' WHERE venue = "' . $venue . '"';
    $query = 'UPDATE dbshiftsnew SET capacity = "' . $capacity . '" WHERE venue = "' . $venue . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
      return true;
}

function editCapacity2($venue, $day_num, $start_time_value, $capacity){
    $con=connect();
    //$query = 'UPDATE dbshiftsnew SET reserved = '" . $capacity . "' WHERE day_num = "' . $day_num . '" AND start_time_value = '" . $start_time_value . "' AND venue = '" . $venue . "';
    $query = 'UPDATE dbshiftsnew SET capacity = "' . $capacity . '" WHERE day_num = "' . $day_num . '" AND start_time_value = "' . $start_time_value . '" AND venue = "' . $venue . '"';
    $result = mysqli_query($con,$query);
    $s = $start_time_value+0.5;
    $query = 'UPDATE dbshiftsnew SET capacity = "' . $capacity . '" WHERE day_num = "' . $day_num . '" AND start_time_value = "' . $s . '" AND venue = "' . $venue . '"';
    $result = mysqli_query($con,$query);
    $s = $s+0.5;
    $query = 'UPDATE dbshiftsnew SET capacity = "' . $capacity . '" WHERE day_num = "' . $day_num . '" AND start_time_value = "' . $s . '" AND venue = "' . $venue . '"';
    $result = mysqli_query($con,$query);
    $s = $s+0.5;
    $query = 'UPDATE dbshiftsnew SET capacity = "' . $capacity . '" WHERE day_num = "' . $day_num . '" AND start_time_value = "' . $s . '" AND venue = "' . $venue . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
      return true;
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

// increments reserved in the approprate entires of the shift table
function increment_reserved($num_children, $day_num, $time, $venue){
    $con=connect();

    $query = "SELECT * FROM dbshiftsnew WHERE day_num = '" . $day_num . "' AND venue = '" . $venue . "' AND start_time_value >= '" . $time . "' AND start_time_value < '" . $time+2 . "' ORDER BY start_time_value ASC";
    $results = mysqli_query($con,$query);

    //First, check if all rows can handle the number of children are being reserved in time slot
    while($row = $results->fetch_assoc()){
        // check if there is enough space.
        // if not, return false (cannot reserve space)
        // if yes, continue to reserving space
        if(($row['capacity'] - $row['reserved']) < $num_children){
            mysqli_close($con);
            return false;
        }
    }

    $query = "SELECT * FROM dbshiftsnew WHERE day_num = '" . $day_num . "' AND venue = '" . $venue . "' AND start_time_value >= '" . $time . "' AND start_time_value < '" . $time+2 . "' ORDER BY start_time_value ASC";
    $results = mysqli_query($con,$query);
    
    //Second, update the reserved spot in the 4 incremented slots
    while($row = $results->fetch_assoc()){
        $new_reserved = $row['reserved'] + $num_children;
        $start_time = $row['start_time_value'];
        $query = "UPDATE dbshiftsnew SET reserved = '" . $new_reserved . "' WHERE day_num = '" . $day_num . "' AND venue = '" . $venue . "' AND start_time_value = '" . $start_time . "'";
        //$query = "UPDATE dbshiftsnew SET reserved = '$new_reserved' WHERE day_num = '$day_num' AND start_time_value = '$start_time'";
        mysqli_query($con,$query);
    }
    
    mysqli_close($con);
    return true;
}

// decrement reserved 
function decrement_reserved($num, $day_num, $time){
    $con=connect();
    $query = "SELECT * FROM dbshiftsnew WHERE day_num = '" . $day_num . "' AND start_time_value >= '" . $time . "' AND start_time_value < '" . $time+2 . "' ORDER BY start_time_value ASC";
    $results = mysqli_query($con,$query);
    
    //Second, update the reserved spot in the 4 incremented slots
    while($row = $results->fetch_assoc()){
        $new_reserved = $row['reserved'] - $num;
        $start_time = $row['start_time_value'];
        $query = "UPDATE dbshiftsnew SET reserved = '" . $new_reserved . "' WHERE day_num = '" . $day_num . "' AND start_time_value = '" . $start_time . "'";
        mysqli_query($con,$query);
    }
    
    mysqli_close($con);
    return true;
}
?>
