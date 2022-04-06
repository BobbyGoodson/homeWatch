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
 class Person {

	/* private fields */

	private $id;         // id (unique key) = email
	private $first_name; // first name as a string
	private $last_name;  // last name as a string
	private $phone;   // primary phone number as int
	private $barcode; // ymca barcode as string
	private $email;   // email address as a string
	private $position;    // a person may be a "child", "watcher", "guardian", or "admin"
	private $password;     // password for calendar and database access: default = $id
	private $venue;			//location


	/* constructor */

	function __construct($first_name, $last_name, $phone, $barcode, $email, $position, $password, $venue) {
		$this->id = $email;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->phone = $phone;
		$this->barcode = $barcode;
		$this->email = $email;
		$this->position = $position;
		$this->password = $password;
		$this->venue = $venue;
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

	function get_phone() {
		return $this->phone;
	}

	function get_barcode() {
		return $this->barcode;
	}

	function get_email() {
		return $this->email;
	}


	function get_position() {
		return $this->position;
	}

	function get_password() {
		return $this->password;
	}

	function get_venue() {
		return $this->venue;
	}


	/* all setters */

	function set_first_name($first_name) {
        $this->first_name = $first_name;
    }

	function set_last_name($last_name) {
        $this->last_name = $last_name;
    }

	function set_phone($phone) {
        $this->phone = $phone;
    }

	function set_barcode($barcode) {
        $this->barcode = $barcode;
    }

	function set_email($email) {
		$this->email = $email;
		$this->id = $email;
	}

	function set_position($position) {
        $this->position= $position;
    }

	function set_password($password) {
        $this->password= $password;
    }

	function set_venue($venue) {
        $this->venue = $venue;
    }
}
?>