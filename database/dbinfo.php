<?php
/*
 * dbinfo.php
 */

/*
 * This file is only the connection information for the database.
 * This file will be modified for every installation.
 */

function connect() {
    $host = "localhost"; 
    $database = "homebasedb";
    $user = "homebasedb";
    $pass = "homebasedb";

    $con = mysqli_connect($host,$user,$pass,$database);
    if (!$con) { echo "not connected to server"; return mysqli_error($con);}
    $selected = mysqli_select_db($con,$database);
    if (!$selected) { echo "database not selected"; return mysqli_error($con); }
    else return $con;
    
}
?>