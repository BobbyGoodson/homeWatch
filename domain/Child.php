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
	private $first_name;
	private $last_name;
	private $DOB;  
	private $health_requirements;
    private $parent_email;
				

	/* constructor */

	function __construct($first_name, $last_name, $DOB, $health_requirements, $parent_email) {
		$this->id = $first_name . "*" . $last_name . "*" . $parent_email;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->DOB = $DOB;
		$this->health_requirements = $health_requirements;
        $this->parent_email = $parent_email;
	}


	/* all getters */

	function get_id() {
		return $this->id;
	}

	function get_first_name() {
		return $this->first_name;
	}

	function get_last_name() {
		return $this->last_name;
	}

	function get_DOB() {
		return $this->DOB;
	}

    function get_health_requirements() {
		return $this->health_requirements;
	}

	function get_parent_email() {
		return $this->parent_email;
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
}
?>