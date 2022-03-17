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

	private $id;         // id (unique key) = email
	private $first_name; // first name as a string
	private $last_name;  // last name as a string
	private $phone;   // primary phone number as int
	private $barcode; // ymca barcode as string
	private $email;   // email address as a string
	private $children; // array of persons (children)
	private $birthday;     // format: 64-03-12
	private $health_requirements; // children health requirements
	private $position;    // a person may be a "child", "watcher", "guardian", or "admin"
	private $password;     // password for calendar and database access: default = $id



	function __construct($f, $l, $p, $e, $pos, $bd, $pass) {
		$this->id = $e;
		$this->first_name = $f;
		$this->last_name = $l;
		$this->phone = $p;
		$this->birthday = $bd;
		$this->email = $e;
		$this->position = $pos;
		if ($pass == "")
			$this->password = md5($this->id);
		else
			$this->password = $pass;  // default password == md5($id)
	}


	// /* all getters */

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

	function get_children() {
	 	return $this->children;
	}

	function get_birthday() {
	 	return $this->birthday;
	}

	function get_health_requirements() {
	 	return $this->health_requirements;
	}

	function get_position() {
	 	return $this->position;
	}

	function get_password() {
	 	return $this->password;
	}


	// /* all setters */

	function set_id($new_id) {
		$this->id = $new_id;
	}

	function set_first_name($new_first_name) {
		$this->first_name = $new_first_name;
	}

	function set_last_name($new_last_name) {
		$this->last_name = $new_last_name;
	}

	function set_phone($new_phone) {
		$this->phone = $new_phone;
	}

	function set_barcode($new_barcode) {
		$this->barcode= $new_barcode;
	}

	function set_email($new_email) {
		$this->email = $new_email;
	}

	function set_birthday($new_birthday) {
		$this->birthday= $new_birthday;
	}

	function set_health_requirements($new_health_requirements) {
		$this->health_requirements= $new_health_requirements;
	}

	function set_position($new_position) {
		$this->position= $new_position;
	}

	function set_password($new_password) {
		$this->password= $new_password;
	}

	// // add child function
	// function add_child($child) {

	// 	// push new child to "children" array
	// 	array_push($this->children, $child);
	// 	// add new child to database
	//	add_person($child);
	//}

	// // delete child function
	// function delete_child($child) {

	// 	// loop through "children" array and search for child
	// 	if ($key = array_search($child, $children, $strict)) != FALSE) {

	// 		// remove that child from "children" array
	// 		unset($this->children[$key]);
	// 	}

	// 	// remove child from database
	// 	remove_person($child->get_id);
	// }
}
?>