<?php
/*
 * Copyright 2013 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/**
 * @version March 1, 2012
 * @author Oliver Radwan and Allen Tucker
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/Child.php');

/*
 * add a child to dbChildren table: if already there, return false
 */

function add_child($child) {
    if (!$child instanceof Child)
        die("Error: add_child type mismatch");
    $con=connect();
    $query = "SELECT * FROM dbChildren WHERE id = '" . $child->get_id() . "'";
    $result = mysqli_query($con,$query);
    //if there's no entry for this id, add it
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_query($con,'INSERT INTO dbChildren VALUES("' .  
                $child->get_id() . '","' .
		    $child->get_DOB() . '","' .
                $child->get_first_name() . '","' .
                $child->get_last_name() . '","'
                $child->get_health_requirements() . '","' . 
                $child->get_parent_email() . '","'.
                '");');							
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;
}

/*
 * remove a child from dbChildren table.  If already there, return false
 */

function remove_child($id) {
    $con=connect();
    $query = 'SELECT * FROM dbChildren WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM dbChildren WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}

/*
 * @return a Child from dbChildren table matching a particular id.
 * if not in table, return false
 */

function retrieve_child($id) {
    $con=connect();
    $query = "SELECT * FROM dbChildren WHERE id = '" . $id . "'";
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) !== 1) {
        mysqli_close($con);
        return false;
    }
    $result_row = mysqli_fetch_assoc($result);
    // var_dump($result_row);
    $theChild = make_a_child($result_row);
//    mysqli_close($con);
    return $theChild;
}
// Name is first concat with last name. Example 'James Jones'
// return array of Childs.
function retrieve_child_by_name ($name) {
	$child = array();
	if (!isset($name) || $name == "" || $name == null) return $child;
	$con=connect();
	$name = explode(" ", $name);
	$first_name = $name[0];
	$last_name = $name[1];
    $query = "SELECT * FROM dbChildren WHERE first_name = '" . $first_name . "' AND last_name = '". $last_name ."'";
    $result = mysqli_query($con,$query);
    while ($result_row = mysqli_fetch_assoc($result)) {
        $the_child = make_a_child($result_row);
        $child[] = $the_child;
    }
    return $child;	
}

function change_password($id, $newPass) {
    $con=connect();
    $query = 'UPDATE dbChildren SET password = "' . $newPass . '" WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

function update_hours($id, $new_hours) {
    $con=connect();
    $query = 'UPDATE dbChildren SET hours = "' . $new_hours . '" WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

function update_birthday($id, $new_birthday) {
	$con=connect();
	$query = 'UPDATE dbChildren SET DOB = "' . $new_birthday . '" WHERE id = "' . $id . '"';
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	return $result;
}

function update_start_date($id, $new_start_date) {
	$con=connect();
	$query = 'UPDATE dbChildren SET start_date = "' . $new_start_date . '" WHERE id = "' . $id . '"';
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	return $result;
}

/*
 * @return all rows from dbChildren table ordered by last name
 * if none there, return false
 */

function getall_dbChildren($name_from, $name_to, $venue) {
    $con=connect();
    $query = "SELECT * FROM dbChildren";
    $query.= " WHERE venue = '" .$venue. "'"; 
    $query.= " AND last_name BETWEEN '" .$name_from. "' AND '" .$name_to. "'"; 
    $query.= " ORDER BY last_name,first_name";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $theChilds = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $theChild = make_a_child($result_row);
        $theChilds[] = $theChild;
    }

    return $theChilds;
}

function getall_volunteer_names() {
	$con=connect();
	$query = "SELECT first_name, last_name FROM dbChildren ORDER BY last_name,first_name";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $names = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $names[] = $result_row['first_name'].' '.$result_row['last_name'];
    }
    mysqli_close($con);
    return $names;   	
}

function make_a_child($result_row) {
	
    $theChild = new Child(
                    $result_row['id'],
                    $result_row['DOB'],
                    $result_row['first_name'],
                    $result_row['last_name'],
                    $result_row['health_requirements'], 
                    $result_row['parent_email']);  
    return $theChild;
}

function getall_names($status, $type, $venue) {
    $con=connect();
    $result = mysqli_query($con,"SELECT id,first_name,last_name,type FROM dbChildren " .
            "WHERE venue='".$venue."' AND status = '" . $status . "' AND TYPE LIKE '%" . $type . "%' ORDER BY last_name,first_name");
    mysqli_close($con);
    return $result;
}

/*
 * @return all active people of type $t or subs from dbChildren table ordered by last name
 */

function getall_type($t) {
    $con=connect();
    $query = "SELECT * FROM dbChildren WHERE (type LIKE '%" . $t . "%' OR type LIKE '%sub%') AND status = 'active'  ORDER BY last_name,first_name";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    mysqli_close;
    return $result;
}

/*
 *   get all active volunteers and subs of $type who are available for the given $frequency,$week,$day,and $shift
 */

function getall_available($type, $day, $shift, $venue) {
    $con=connect();
    $query = "SELECT * FROM dbChildren WHERE (type LIKE '%" . $type . "%' OR type LIKE '%sub%')" .
            " AND availability LIKE '%" . $day .":". $shift .
            "%' AND status = 'active' AND venue = '" . $venue . "' ORDER BY last_name,first_name";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}


// retrieve only those child that match the criteria given in the arguments
function getonlythose_dbChildren($type, $status, $name, $day, $shift, $venue) {
   $con=connect();
   $query = "SELECT * FROM dbChildren WHERE type LIKE '%" . $type . "%'" .
           " AND status LIKE '%" . $status . "%'" .
           " AND (first_name LIKE '%" . $name . "%' OR last_name LIKE '%" . $name . "%')" .
           " AND availability LIKE '%" . $day . "%'" . 
           " AND availability LIKE '%" . $shift . "%'" . 
           " AND venue = '" . $venue . "'" . 
           " ORDER BY last_name,first_name";
   $result = mysqli_query($con,$query);
   $theChilds = array();
   while ($result_row = mysqli_fetch_assoc($result)) {
       $theChild = make_a_child($result_row);
       $theChilds[] = $theChild;
   }
   mysqli_close($con);
   return $theChilds;
}

function phone_edit($phone) {
    if ($phone!="")
		return substr($phone, 0, 3) . "-" . substr($phone, 3, 3) . "-" . substr($phone, 6);
	else return "";
}

function get_people_for_export($attr, $first_name, $last_name, $type, $status, $start_date, $city, $zip, $phone, $email) {
	$first_name = "'".$first_name."'";
	$last_name = "'".$last_name."'";
	$status = "'".$status."'";
	$start_date = "'".$start_date."'";
	$city = "'".$city."'";
	$zip = "'".$zip."'";
	$phone = "'".$phone."'";
	$email = "'".$email."'";
	$select_all_query = "'.'";
	if ($start_date == $select_all_query) $start_date = $start_date." or start_date=''";
	if ($email == $select_all_query) $email = $email." or email=''";
    
	$type_query = "";
    if (!isset($type) || count($type) == 0) $type_query = "'.'";
    else {
    	$type_query = implode("|", $type);
    	$type_query = "'.*($type_query).*'";
    }
    
    error_log("query for start date is ". $start_date);
    error_log("query for type is ". $type_query);
    
   	$con=connect();
    $query = "SELECT ". $attr ." FROM dbChildren WHERE 
    			first_name REGEXP ". $first_name . 
    			" and last_name REGEXP ". $last_name . 
    			" and (type REGEXP ". $type_query .")". 
    			" and status REGEXP ". $status . 
    			" and (start_date REGEXP ". $start_date . ")" .
    			" and city REGEXP ". $city .
    			" and zip REGEXP ". $zip .
    			" and (phone1 REGEXP ". $phone ." or phone2 REGEXP ". $phone . " )" .
    			" and (email REGEXP ". $email .") ORDER BY last_name, first_name";
	error_log("Querying database for exporting");
	error_log("query = " .$query);
    $result = mysqli_query($con,$query);
    return $result;

}

//return an array of "last_name:first_name:birth_date", and sorted by month and day
function get_birthdays($name_from, $name_to, $venue) {
	$con=connect();
   	$query = "SELECT * FROM dbChildren WHERE availability LIKE '%" . $venue . "%'" . 
   	$query.= " AND last_name BETWEEN '" .$name_from. "' AND '" .$name_to. "'";
    $query.= " ORDER BY birthday";
	$result = mysqli_query($con,$query);
	$theChilds = array();
	while ($result_row = mysqli_fetch_assoc($result)) {
    	$theChild = make_a_child($result_row);
        $theChilds[] = $theChild;
	}
   	mysqli_close($con);
   	return $theChilds;
}

//return an array of "last_name;first_name;hours", which is "last_name;first_name;date:start_time-end_time:venue:totalhours"
// and sorted alphabetically
function get_logged_hours($from, $to, $name_from, $name_to, $venue) {
	$con=connect();
   	$query = "SELECT first_name,last_name,hours,venue FROM dbChildren "; 
   	$query.= " WHERE venue = '" .$venue. "'";
   	$query.= " AND last_name BETWEEN '" .$name_from. "' AND '" .$name_to. "'";
   	$query.= " ORDER BY last_name,first_name";
	$result = mysqli_query($con,$query);
	$theChilds = array();
	while ($result_row = mysqli_fetch_assoc($result)) {
		if ($result_row['hours']!="") {
			$shifts = explode(',',$result_row['hours']);
			$goodshifts = array();
			foreach ($shifts as $shift) 
			    if (($from == "" || substr($shift,0,8) >= $from) && ($to =="" || substr($shift,0,8) <= $to))
			    	$goodshifts[] = $shift;
			if (count($goodshifts)>0) {
				$newshifts = implode(",",$goodshifts);
				array_push($theChilds,$result_row['last_name'].";".$result_row['first_name'].";".$newshifts);
			}   // we've just selected those shifts that follow within a date range for the given venue
		}
	}
   	mysqli_close($con);
   	return $theChilds;
}
?>