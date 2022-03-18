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
    if ($person->get_first_name()=="new" && ($_POST['first_name'] == NULL || $_POST['first_name'] == 'new'))
        $errors[] = 'Please enter a first name';
    if ($_POST['last_name'] == null)
        $errors[] = 'Please enter a last name';
    //if ($person->get_phone1()==null && !valid_phone($_POST['phone1']))
    if (!valid_phone($_POST['phone1']))
        $errors[] = 'Enter a valid primary phone number (10 digits: ### ### ####)';
    if ($_POST['barcode'] == null)
        $errors[] = 'Please enter a barcode';
    if ($_POST['password'] == null)
        $errors[] = 'Please enter a password';
    return $errors;
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
    $phone = str_replace(' ', '', str_replace('+', '', str_replace('(', '', str_replace('(', '', str_replace('-', '', $phone)))));
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