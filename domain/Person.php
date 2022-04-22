<?php
/*
 * Person.php
 * Person Class
 */

class Person {

	/* private fields */
	private $id; // id (unique key) = email
	private $first_name;
	private $last_name;
	private $phone;   
	private $barcode; 
	private $email;   
	private $position; // a person may be a "child", "watcher", "guardian", or "admin"
	private $password;    
	private $venue;		


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