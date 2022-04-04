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
                $child->get_first_name() . '","' .
                $child->get_last_name() . '","' .
                $child->get_DOB() . '","' .
                $child->get_health_requirements() . '","' .
                $child->get_parent_email() .
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

/*
    retrieve children id using the gaurdian's email
*/
function retrieve_child_by_email($email){
    $children_id = array();
    $con=connect();
    $query = "SELECT * FROM dbChildren WHERE parent_email = '" . $email . "'";
    $result = mysqli_query($con,$query);
    $i = 0;
    while ($result_row = mysqli_fetch_assoc($result)) {
        $children_id[$i] = $result_row['id'];
        $i = $i + 1;
    }
    return $children_id;
}

function update_birthday($id, $new_birthday) {
	$con=connect();
	$query = 'UPDATE dbChildren SET DOB = "' . $new_birthday . '" WHERE id = "' . $id . '"';
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	return $result;
}

function get_health_requirements($id){
    $con=connect();
    $query = 'SELECT health_requirements from dbChildren WHERE id = "' . $id . '" LIMIT 1';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    while ($row = mysqli_fetch_assoc($result)) {
        return $row['health_requirements'];
    }
    return false;
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

function make_a_child($result_row) {
	
    $theChild = new Child(
                    $result_row['first_name'],
                    $result_row['last_name'],
                    $result_row['DOB'],
                    $result_row['health_requirements'], 
                    $result_row['parent_email']);  
    return $theChild;
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

?>