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
 * make all four new entries into the table, adding a child for the 4 30 minute time slots
 */
function add_entry($childID, $shift_day, $shift_start_time) {
    $con=connect();
    $query = "SELECT * FROM children_in_shifts WHERE child_id = '" . $childID . "' AND shift_day = '" . $shift_day . "' AND shift_start_time = '" . $shift_start_time . "'";
    $result = mysqli_query($con,$query);
    //if there's no entry for this id, add it
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_query($con,'INSERT INTO children_in_shifts VALUES("' .
                $childID . '","' .
                $shift_day . '","' .
                $shift_start_time . '");');							
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;
}

// gets all children currently reserved 
function getall_currently_reserved() {
    $con=connect();
    $query = "SELECT * FROM children_in_shifts ORDER BY shifts_start_time ASC";
    $result = mysqli_query($con,$query);
    if($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

/*
 * check if a child is in any reserved space
 */
function check_if_child_reserved($childID){
    $con=connect();
    $query = "SELECT child_id FROM children_in_shifts WHERE child_id = '" . $childID . "'";
    $result = mysqli_query($con,$query);
    //if there's no entry for this id, add it
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    mysqli_close($con);
    return true;
}

?>