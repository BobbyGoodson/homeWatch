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
 * created February 23, 2012
 * @Jackson Moniaga
 */
use PHPUnit\Framework\TestCase;
include_once(dirname(__FILE__).'/../domain/ApplicantScreening.php');
include_once(dirname(__FILE__).'/../database/dbApplicantScreenings.php');

class dbApplicantScreeningsTest extends TestCase {
      function testdbApplicantScreeningsModule() {
		
		//create empty dbApplicantScreenings table
		//$this->assertTrue(create_dbApplicantScreenings());
		
		// create several applicant screening objects to add to table
		$screening1 = new ApplicantScreening("guestchef", "Gabrielle1111234567", 
				"complete application,background check,complete interview", 
				"unpublished");
		$screening2 = new ApplicantScreening("volunteer", "Jackson6269170632", 
				"complete interview", "published");
		$screening3 = new ApplicantScreening("manager", "Jill2075556666", null, null);
		$screening4 = new ApplicantScreening("socialworker", "Jackson6269170632", 
				null, "unpublished");	
		$this->assertTrue(insert_dbApplicantScreenings($screening1));
		$this->assertTrue(insert_dbApplicantScreenings($screening2));
		$this->assertTrue(insert_dbApplicantScreenings($screening3));
		$this->assertTrue(insert_dbApplicantScreenings($screening4));
		
		//tests the retrieve function
		$this->assertEquals(retrieve_dbApplicantScreenings($screening1->get_type())->get_type(), "guestchef");
		$this->assertEquals(retrieve_dbApplicantScreenings($screening1->get_type())->get_creator(), "Gabrielle1111234567");
		$this->assertEquals(retrieve_dbApplicantScreenings($screening1->get_type())->get_steps(), array("complete application", "background check", "complete interview"));
		$this->assertEquals(retrieve_dbApplicantScreenings($screening1->get_type())->get_status(), "unpublished");
		
		//tests the update function
		$screening1->set_status("published");
		$this->assertTrue(update_dbApplicantScreenings($screening1));
		$this->assertEquals(retrieve_dbApplicantScreenings($screening1->get_type())->get_status(), "published");
		
		// tests delete function
		$this->assertTrue(delete_dbApplicantScreenings($screening1->get_type()));
		$this->assertTrue(delete_dbApplicantScreenings($screening2->get_type()));
		$this->assertTrue(delete_dbApplicantScreenings($screening3->get_type()));
		$this->assertTrue(delete_dbApplicantScreenings($screening4->get_type()));
   	  	
		echo "testdbApplicantScreenings complete\n";
      } 
	
}

?>