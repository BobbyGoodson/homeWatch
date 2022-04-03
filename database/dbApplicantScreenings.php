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
 * @version February 23, 2012
 * @author Jackson Moniaga
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__) . '/../domain/ApplicantScreening.php');

function create_dbApplicantScreenings() {
    $con=connect();
    mysqli_query($con,"DROP TABLE IF EXISTS dbApplicantScreenings");
    $result = mysqli_query($con,"CREATE TABLE dbApplicantScreenings (type TEXT NOT NULL, 
    	creator TEXT, steps TEXT, status TEXT)");
    mysqli_close($con);
    if (!$result) {
        echo mysqli_error($con) . "Error creating dbApplicantScreenings table. <br>";
        return false;
    }
    $screening = new ApplicantScreening($type, $_SESSION['_id'], "", "unpublished");
    return true;
}

function insert_dbApplicantScreenings($screening) {
    if (!$screening instanceof ApplicantScreening) {
        return false;
    }
    
    $con=connect();
    $query = "SELECT * FROM dbApplicantScreenings WHERE type = '" . $screening->get_type() . "'";
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) != 0) {
        delete_dbApplicantScreenings($screening->get_type());
        $con=connect();
    }

    $query = "INSERT INTO dbApplicantScreenings VALUES ('" .
            $screening->get_type() . "','" .
            $screening->get_creator() . "','" .
            implode(",", $screening->get_steps()) . "','" .
            $screening->get_status() .
            "');";
    $result = mysqli_query($con,$query);
    if (!$result) {
        echo (mysqli_error($con) . " unable to insert into dbApplicantScreenings: " . $screening->get_type() . "\n");
        mysqli_close($con);
        return false;
    }
    mysqli_close($con);
    return true;
}

function retrieve_dbApplicantScreenings($type) {
    $con=connect();
    $query = "SELECT * FROM dbApplicantScreenings WHERE type = '" . $type . "'";
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) !== 1) {
        mysqli_close($con);
        return false;
    }
    $result_row = mysqli_fetch_assoc($result);
    $theScreening = new ApplicantScreening($result_row['type'], $result_row['creator'],
                    $result_row['steps'], $result_row['status']);
    mysqli_close($con);

    return $theScreening;
}

function getall_ApplicantScreenings() {
    $con=connect();
    $query = "SELECT * FROM dbApplicantScreenings ORDER BY type";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $theScreenings = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $theScreening = new ApplicantScreening($result_row['type'], $result_row['creator'],
                        $result_row['steps'], $result_row['status']);
        $theScreenings[] = $theScreening;
    }
    mysqli_close($con);
    return $theScreenings;
}

function update_dbApplicantScreenings($screening) {
    if (!$screening instanceof ApplicantScreening) {
        echo ("Invalid argument for update_dbApplicantScreenings function call");
        return false;
    }
    if (delete_dbApplicantScreenings($screening->get_type()))
        return insert_dbApplicantScreenings($screening);
    else {
        echo (mysqli_error($con) . "unable to update dbApplicantScreenings table: " . $screening->get_type());
        return false;
    }
}

function delete_dbApplicantScreenings($type) {
    $con=connect();
    $query = "DELETE FROM dbApplicantScreenings WHERE type=\"" . $type . "\"";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    if (!$result) {
        echo (mysqli_error($con) . " unable to delete from dbApplicantScreenings: " . $type);
        return false;
    }
    return true;
}

?>