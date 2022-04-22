<?php
/*
 * dbChildren_in_shifts.php
 * Database for Reserved Children in Time Slots
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
    $query = "SELECT * FROM children_in_shifts ORDER BY shifts_day, shifts_start_time ASC";
    $result = mysqli_query($con,$query);
    if($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

function get_child_reservation($child_id){
    $con=connect();
    $query = "SELECT * FROM children_in_shifts WHERE child_id = '" . $child_id . "'";
    $result = mysqli_query($con,$query);
    if($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        mysqli_close($con);
        return $row;
    }
    return false;
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


/*
 * remove a reservation
 */
function remove_reservation($child_id, $start_time){
    $con=connect();
    $query = "DELETE FROM children_in_shifts WHERE child_id = '" . $child_id . "' AND shifts_start_time = '" . $start_time . "'";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}
?>