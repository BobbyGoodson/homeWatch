<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHC-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/*
 * Created on Mar 28, 2008
 * @author Oliver Radwan <oradwan@bowdoin.edu>, Sam Roberts, Allen Tucker
 * @version 3/28/2008, revised 7/1/2015
 */
 class Child {

	/* private fields */

         
	private $first_name; // first name as a string
	private $last_name;  // last name as a string
	private $health_requirements; // children health requirements
				


	/* constructor */

	function __construct($first_name, $last_name, $health_requirements) {
		
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->health_requirements = $health_requirements;
	}


	/* all getters */

	

	function get_first_name() {
		return $this->first_name;
	}

	function get_last_name() {
		return $this->last_name;
	}

	

	

	function get_health_requirements() {
		return $this->health_requirements;
	}

	

	/* all setters */

	function set_first_name($first_name) {
        $this->first_name = $first_name;
    }

	function set_last_name($last_name) {
        $this->last_name = $last_name;
    }

	

	function set_health_requirements($health_requirements) {
        $this->health_requirements= $health_requirements;
    }

	

	// add child function
	function add_child($child) {

		// push new child's first name to "children" array
		array_push($this->children, $child->get_first_name);
		// add new child to database
		add_child($child);
	}

	// delete child function
	function delete_child($child) {

		// loop through "children" array and search for child's first name
		if ($key = array_search($child->get_first_name, $children, $strict) != FALSE) {

			// remove that child from "children" array
			unset($this->children[$key]);
		}

		// remove child from database
		remove_child($child->get_id);
	}
}
?>