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

      private $id; 
      private $DOB;  
	private $first_name; // first name as a string
	private $last_name;  // last name as a string
	private $health_requirements;
      private $parent_email; // children health requirements
				


	/* constructor */

	function __construct($id, $DOB, $first_name, $last_name, $health_requirements) {
		$this->id = $id;
            $this->DOB = $DOB;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->health_requirements = $health_requirements;\
            $this->parent_email = $parent_email;
	}


	/* all getters */

	function get_id() {
		return $this->id;
	}

      function get_parent_email() {
		return $this->parent_email;
	}

      function get_health_requirements() {
		return $this->health_requirements;
	}

      function get_DOB() {
		return $this->first_DOB;
	}


	function get_first_name() {
		return $this->first_name;
	}

	function get_last_name() {
		return $this->last_name;
	}

	

	/* all setters */

	function set_first_name($first_name) {
        $this->first_name = $first_name;
    }

	function set_last_name($last_name) {
        $this->last_name = $last_name;
    }
    function set_DOB($DOB) {
        $this->DOB = $DOB;
    }

	function set_health_requirements($health_requirements) {
        $this->health_requirements = $health_requirements;
    }
    function set_parent_email($parent_email) {
        $this->parent_email = $parent_email;
    }

	function set_id($id) {
        $this->id = $id;
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