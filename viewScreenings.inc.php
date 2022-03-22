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

/*
 * 	viewScreenings.inc
 *  shows a form for a screening to be added or edited in the database
 * 	@author Jackson Moniaga
 * 	@version 4/16/2012
 */

if ($_SESSION['access_level'] < 2) {
    echo("<p id=\"error\">Only managers can view the master schedule.</p>");
    include('footer.inc');
    die();
}
include_once('database/dbApplicantScreenings.php');
include_once('domain/ApplicantScreening.php');

echo('<form method="POST">');
if ($action == "select") {
    echo('<input type="hidden" name = "_form_submit" value="1">');

    echo('<p>Type:&nbsp;&nbsp;<select name="s_type">');

    $screenings = getall_ApplicantScreenings();
    $screeningtypes = array();

    foreach ($screenings as $s) {
        $t = $s->get_type();
        array_push($screeningtypes, $t);
        if ($screening->get_type() == $t) {
            echo('<option value ="' . $t . '" SELECTED>' . $t . '</option>');
        } else {
            echo('<option value ="' . $t . '"> ' . $t . '</option>');
        }
    }
    if (!in_array("new", $screeningtypes))
        echo('<option value="new">new</option>');

    echo('</select>');

    echo('<p>Hit <input type="submit" value="Submit" name="Submit Edits"> to select this screening.<br><br>');
}
else {
    echo('<input type="hidden" name = "_form_submit" value="2">');
    echo('<input type="hidden" name = "_old_type" value="' . $action . '">');
    echo('<input type="hidden" name = "_form_type" ');
    if ($new)
        echo ('value="new">');
    else
        echo ('value="change">');

    $screening = retrieve_dbApplicantScreenings($action);

    echo "Creator: " . $screening->get_creator() . "<br><br>";

    if (!$new)
        echo('Rename ');
    echo('Type:&nbsp <input type="text" name="new_type" ');
    if ($new)
        echo('/><p>');
    else
        echo ('value="' . $screening->get_type() . '" /><p>');

    echo('<fieldset><legend>Steps: </legend>');

    $st = $screening->get_steps();
    if ($st != null) {
        $i == 0;
        foreach ($st as $step) {  // show existing steps for this screening
            echo('<p>' . ($i + 1) . '. ' . '<input type="text" name="steps[]" value="' . $step . '" size="60" />');
            $i++;
        }
    }
    while ($i < 10) { // show spare steps as blank
        echo('<p>' . ($i + 1) . '. ' . '<input type="text" name="steps[]" value= "" size="60" />');
        $i++;
    }
    echo('<br> &nbsp </fieldset><br>');

// set status radio buttons
    echo "<p>Status: ";
    echo('<input type="radio" name="Status" value="published" ');
    if ($screening->get_status() == "published")
        echo "checked";
    echo(' />published  ');
    echo('<input type="radio" name="Status" value="unpublished" ');
    if ($screening->get_status() == "unpublished")
        echo "checked";
    echo(' />unpublished');


    echo('<br><br>');
    echo ('<input type="checkbox" name="deleteMe" value="DELETE"> Check this box and then hit ' .
    '<input type="submit" value="Delete" name="Delete Entry"> to delete this screening. <br>');

    echo('<p>Hit <input type="submit" value="Submit" name="Submit Edits"> to save your changes.<br><br>');
}

echo('</form>');
?>