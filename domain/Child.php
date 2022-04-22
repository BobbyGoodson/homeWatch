<?php
/*
 * Child.php
 * Child Class
 */

class Child {

	/* private fields */
    private $id; // id (unique key) = first_name + last_name + parent_email
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