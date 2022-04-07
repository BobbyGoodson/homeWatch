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
 * validate_form validates the form data, checking all legality.
 * it returns an array of the errors with the form (string warnings)
 * this array is null (aka false) if there are no errors
 */
function validate_form($person) {
    if ($_POST['first_name'] == NULL || $_POST['first_name'] == 'new' || 
        $_POST['last_name'] == null || $_POST['barcode'] == null || $_POST['password'] == null){
        $errors[] = 'Missing field(s)';
    }
    if (!valid_phone($_POST['phone'])) {
        $errors[] = 'Enter a valid primary phone number (10 digits: ### ### ####)';
    }
    if ($person->get_password() != $_POST['passwordConfirm'])
        $errors[] = 'Invalid Password. No changes were made.';
    return $errors;
}

/**
 * validate the drop-in form in drop_in.php and drop_in.inc
 */
function validate_dropin_form(){
    if ($_POST['g_first_name'] == NULL || $_POST['g_last_name'] == NULL || $_POST['c_age'] == NULL ||
        $_POST['g_whereabouts'] == null || $_POST['c_first_name'] == null || $_POST['c_last_name'] == null){
        $errors[] = 'Missing field(s)';
    }
    if (!valid_phone($_POST['phone'])) {
        $errors[] = 'Enter a valid primary phone number (10 digits: ### ### ####)';
    }
    return $errors;
}

/**
 * validate the add child form in childEdit.php and childEdit.inc
 */
function validate_child_form(){
    if ($_POST['first_name'] == NULL || $_POST['last_name'] == NULL || $_POST['DOB'] == NULL){
        $errors[] = 'Missing field(s)';
    }
    if (!valid_DOB($_POST['DOB'])){
        $errors[] = 'DOB not valid (mm/dd/yyyy)';
    }
    return $errors;
}

/**
 * Validate the DOB
 */
function valid_DOB(&$DOB){
    if ($DOB == null){
        return false;
    }
    $DOB = str_replace(' ', '', str_replace('/', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $DOB)))));
    $test = str_replace('0', '', str_replace('1', '', str_replace('2', '', str_replace('3', '', str_replace('4', '', str_replace('5', '', str_replace('6', '', str_replace('7', '', str_replace('8', '', str_replace('9', '', $DOB))))))))));
    if ($test != null)
        return false;
    if ((strlen($DOB)) != 8)
        return false;

    //check if dates amke sense
    if (intval($DOB[0] . $DOB[1]) > 12){
        return false;
    }
    if (intval($DOB[2] . $DOB[3]) > 31){
        return false;
    }
    if (intval($DOB[4] . $DOB[5] . $DOB[6] . $DOB[7]) > date("Y",strtotime("now"))){
        return false;
    }
    $DOB = $DOB[0] . $DOB[1] . '/' . $DOB[2] . $DOB[3] . '/' . $DOB[4] . $DOB[5] . $DOB[6] . $DOB[7];
    return true;
}

/**
 * valid_phone validates a phone on the following parameters:
 * 		it assumes the characters '-' ' ' '+' '(' and ')' are valid, but ignores them
 * 		every other digit must be a number
 * 		it should be between 7 and 11 digits
 * returns boolean if phone is valid
 */
function valid_phone(&$phone) {
    if ($phone == null)
        return false;
    $phone = str_replace(' ', '', str_replace('+', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $phone)))));
    $test = str_replace('0', '', str_replace('1', '', str_replace('2', '', str_replace('3', '', str_replace('4', '', str_replace('5', '', str_replace('6', '', str_replace('7', '', str_replace('8', '', str_replace('9', '', $phone))))))))));
    if ($test != null)
        return false;
    if ((strlen($phone)) != 10)
        return false;
    return true;
}

//Function from <http://www.phpit.net/code/valid-email/>
function valid_email($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if (!preg_match("/^(([A-Za-z0-9!#$%&#038;'*+=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
            return false;
        }
    }
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}

function show_errors($e) {
    //this function should display all of our errors.
    echo('<div class="warning">');
    echo('<ul>');
    foreach ($e as $error) {
        echo("<li><strong><font color=\"red\">" . $error . "</font></strong></li>\n");
    }
    echo("</ul></div></p>");
}

?>