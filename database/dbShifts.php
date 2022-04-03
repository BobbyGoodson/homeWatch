<?php
/*
 * Copyright 2015 by Adrienne Beebe, Yonah Biers-Ariel, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 * Error: week-day-time-venue not valid:see get_person_ids mysqli_error
 */
/**
 * Functions to create, update, and retrieve information from the
 * dbShifts table in the database.  This table is used with the Shift
 * class.  Shifts are generated using the master schedule (through the
 * addWeek.php form), and retrieved by the calendar form and editShift.
 * @version Feb 12, 2015
 * @author Xun Wang
 */
include_once(dirname(__FILE__).'/../domain/Shift.php');
include_once(dirname(__FILE__).'/dbPersons.php');
include_once(dirname(__FILE__).'/dbDates.php');
include_once(dirname(__FILE__).'/dbSCL.php');
include_once(dirname(__FILE__).'/dbinfo.php');

/**
 * Inserts a shift into the db
 * @param shift to insert
 */
function insert_dbShifts($s) {
    if (!$s instanceof Shift) {
        die("Invalid argument for insert_dbShifts function call" . $s);
    }
    $con=connect();
    $query = 'SELECT * FROM dbShifts WHERE id ="' . $s->get_id() . '"';
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) != 0) {
        delete_dbShifts($s);
        $con=connect();
    }
    $query = "INSERT INTO dbShifts VALUES (\"" . $s->get_id() . "\",\"" .
            $s->get_start_time() . "\",\"" . $s->get_end_time() . "\",\"" . $s->get_venue() . "\"," .
            $s->num_vacancies() . ",\"" .
            implode("*", $s->get_persons()) . "\",\"" .implode("*", $s->get_removed_persons()) . "\",\"" .
            $s->get_sub_call_list() . "\",\"" . $s->get_notes() . "\")";
    $result = mysqli_query($con,$query);
    if (!$result) {
        echo "unable to insert into dbShifts " . $s->get_id() . mysqli_error($con);
        mysqli_close($con);
        return false;
    }
    mysqli_close($con);
    return true;
}

/**
 * Deletes a shift from the db
 * @param shift to delete
 */
function delete_dbShifts($s) {
    if (!$s instanceof Shift)
        die("Invalid argument for delete_dbShifts function call");
    $con=connect();
    $query = "DELETE FROM dbShifts WHERE id=\"" . $s->get_id() . "\"";
    $result = mysqli_query($con,$query);
    if (!$result) {
        echo "unable to delete from dbShifts " . $s->get_id() . mysqli_error($con);
        mysqli_close($con);
        return false;
    }
    mysqli_close($con);
    return true;
}

/**
 * Updates a shift in the db by deleting it (if it exists) and then replacing it
 * @param shift to update
 */
function update_dbShifts($s) {
	error_log("updating shift in database");
    if (!$s instanceof Shift)
        die("Invalid argument for dbShifts->replace_shift function call");
    delete_dbShifts($s);
    insert_dbShifts($s);
    return true;
}

/**
 * Selects a shift from the database
 * @param shift id
 * @return Shift with that id, or null
 */
function select_dbShifts($id) {
    $con=connect();
    $s = null;
    $query = "SELECT * FROM dbShifts WHERE id =\"" . $id . "\"";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    if (!$result) {
        echo 'Could not run query2: ' . mysqli_error($con);
    } else {
        $result_row = mysqli_fetch_row($result);
        if ($result_row != null) {
        	$persons = array();
        	$parts = explode(":",$result_row[0]);
        	$mmddyyhours = $parts[0].":".$parts[1];
        	$removed_persons = array();
        	if ($result_row[5] != "")
            	$persons = explode("*", $result_row[5]);
            if ($result_row[6] != "")
            	$removed_persons = explode("*", $result_row[6]);
        	$s = new Shift($mmddyyhours, $result_row[3], $result_row[4], $persons, $removed_persons, null, $result_row[8]);
        }
    }
    return $s;
}

/**
 * Returns an array of $ids for all shifts scheduled for the person having $person_id
 */
function selectScheduled_dbShifts($person_id) {
    $con=connect();
    $shift_ids = mysqli_query($con,"SELECT id FROM dbShifts WHERE persons LIKE '%" . $person_id . "%' ORDER BY id");
    $shifts = array();
    if ($shift_ids) {
        while ($thisRow = mysqli_fetch_array($shift_ids, mysqli_ASSOC)) {
            $shifts[] = $thisRow['id'];
        }
    }
    mysqli_close($con);
    return $shifts;
}

/**
 * Returns the month, day, year, start, end, or venue of a shift from its id
 */
function get_shift_month($id) {
    return substr($id, 3, 2);
}

function get_shift_day($id) {
    return substr($id, 6, 2);
}

function get_shift_year($id) {
    return substr($id, 0, 2);
}

function get_shift_start($id) {
	if (substr($id,9,5)=="night") 
		return 0;
	else {
		if (substr($id, 9, 2) == "10"||substr($id, 9, 2) == "11"||substr($id, 9, 2) == "12")
			return substr($id, 9, 2);
	    else {
	    	$st = substr($id,9,1);
	    	if ($st<9)
	    		return $st+12;
	    	else return $st;
	    }
	}
}

function get_shift_end($id) {
	if (substr($id,9,5)=="night")
		return 1;
    else if (substr($id, 11, 2)=="12")
    	return "12";
    else 
        return substr($id, strrpos($id,"-")+1, 1)+12;
}

//Add class get_shift_venue, using the "strrchr" function to return the part after the last ":"
function get_shift_venue($id) {
	return substr(strrchr($id,":"),1);
}

/*
 * Creates the $shift_name of a shift, e.g. "Family Room Shift for Sunday, February 14, 2010 2pm to 5pm"
 *         from its $id, e.g. "02-14-10:9-1:fam"
 */

function get_shift_name_from_id($id) {
	if (strpos($id,"portland")>0) $shift_name = "Portland House Shift: ";
	else $shift_name = "Bangor House Shift: <br>";
    $shift_name .= date("l F j, Y", mktime(0, 0, 0, get_shift_month($id), get_shift_day($id), get_shift_year($id)));
    $shift_name = $shift_name . " ";
    $st = get_shift_start($id);
    $et = get_shift_end($id);
    if ($st==0)
    	$shift_name = $shift_name . "night";
    else {   
    	$st = $st < 12 ? $st . "am" : $st - 12 . "pm";
    	if ($st == "0pm")
   		    $st = "12pm";
    	$et = $et < 12 ? $et . "am" : $et - 12 . "pm";
    	if ($et == "0pm")
        	$et = "12pm";
    	$shift_name = $shift_name . $st . " to " . $et;
    }
    return $shift_name;
}


/**
 * @result == true if $s1's timeslot overlaps $s2's timeslot, and false otherwise.
 * 
 * This can be modified to make sure people don't sign up for time slots back to back
 * IE: 8:00am-10:00am then 10:00am- 12:00pm
 */
function timeslots_overlap($s1_start, $s1_end, $s2_start, $s2_end) {
	if ($s1_start == "0")
		if ($s2_start == "0")
			return true;
		else return false;
	else if ($s2_start == "0")
		return false;
    if ($s1_end > $s2_start) {
        if ($s1_start >= $s2_end)
            return false;
        else
            return true;
    }
    else
        return false;
}

function make_a_shift($result_row) {
    $id = substr($result_row['id'],0,strrpos($result_row['id'],':')); // strip off venue from old id
	$the_shift = new Shift(
    				$id,
    				$result_row['venue'],
                    $result_row['vacancies'],
                    explode('*',$result_row['persons']),
                    explode('*',$result_row['removed_persons']),
					$result_row['sub_call_list'],
                    $result_row['notes']
                 );
    return $the_shift;
}

/**
 * We could use this to make sure people are only signed up, up to two times, since each time slot is
 * 2 hours and we are putting their unique ID (First, Last, Email) for each time frame it falls under,
 * so 8:00am-10:00am they would be in 8:00am-8:30am and 8:30am-9:00am we can just count to see if they
 * show up for a max of 8 times (4 for each reservation)
 */
function get_all_shifts() {
    $con=connect();
    $query = "SELECT * FROM dbShifts";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $shifts = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $shift = make_a_shift($result_row);
        $shifts[] = $shift;
    }

    return $shifts;
}
// remove a person from all future shifts in the current year

/**
 * Could be kept and modified for when people get banned for a week
 */
function remove_from_future_shifts($id) {
	$today = date('y-m-d');
	$con=connect();
	$query = "select * from dbShifts where substring(id,1,8) >= '".$today .
			"' AND persons LIKE '%".$id."%' ";
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	while ($result_row = mysqli_fetch_assoc($result)) {
		$persons_array = explode('*',$result_row['persons']); // individual persons
		for ($i=0; $i<count($persons_array); $i++) {
			$p = explode('+',$persons_array[$i]); // id, first_name, last_name
			if ($p[0]==$id) {
				array_splice($persons_array,$i,1); // remove person from array
				$result_row['vacancies']++;
				$result_row['persons'] = implode('*',$persons_array);
				$s = make_a_shift($result_row);
				update_dbShifts($s);
				break;
			}
		}
	}
}

//returns an array of date:shift:venue:totalhours
/**
 * Could be useful for watchers and admins to see a location
 */

function get_all_venue_shifts($from, $to, $venue) {
	if($venue == ""){
		$all_shifts = get_all_shifts();
	}else{
		$con=connect();
    	$query = "SELECT * FROM dbShifts WHERE venue = '" . $venue . "'";
    	$result = mysqli_query($con,$query);
    	if ($result == null || mysqli_num_rows($result) == 0) {
        	mysqli_close($con);
        	return false;
    	}
    	$result = mysqli_query($con,$query);
    	$all_shifts = array();
    	while ($result_row = mysqli_fetch_assoc($result)) {
        	$shift = make_a_shift($result_row);
        	$all_shifts[] = $shift;
    	}
	}
	return $all_shifts;
}

?>
