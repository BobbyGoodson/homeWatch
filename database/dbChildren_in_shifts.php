<?php
/*
 * Children reserved in time slots
 * 
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
/*function getall_currently_reserved($status, $type, $venue) {
    $con=connect();
    $query = ;
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}*/

?>