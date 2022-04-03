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

/*
 * add a child to dbChildren table: if already there, return false
 */

function add_entry($childID, $shift_day, $shift_start_time) {
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

// gets all children currently reserved 
function getall_currently_reserved($status, $type, $venue) {
    $con=connect();
    $query = "SELECT * FROM children_in_shifts = '" . "'";
    $result = mysqli_query($con,$query);
    if($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $shift = array()
    mysqli_close($con);
    return $result;
}

?>