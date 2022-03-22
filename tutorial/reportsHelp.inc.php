<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>
<script
	src="lib/bootstrap/js/bootstrap.js"></script>

<script>
	$(function () {
		$('img[rel=popover]').popover({
			  html: true,
			  trigger: 'hover',
			  placement: 'right',
			  content: function(){return '<img border="3" src="'+$(this).data('img') + '" width="60%"/>';}
			});
	});
</script>

<p>
	<strong>How to Generate Reports</strong>
<p>
	<B>Step 1:</B> On the navigation bar at the top of the page, find <B>reports</B>
	, like this:<BR> <BR> <a href="tutorial/screenshots/reportsstep1.png"
		class="image" title="reportsstep1.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep1.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep1.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep1.png" border="1px"
		align="center"> </a> <BR>
	<BR>Click on it and you should see the following page: <BR>
	<BR> <a href="tutorial/screenshots/reportsstep1-2.png" class="image"
		title="reportsstep1-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep1-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep1-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep1-2.png"
		border="1px" align="center"> </a>
<p>
	<B>Step 2:</B> If you wish to view total volunteer hours for a particular date range and/or venue, select "Total Hours", 
	first select the date range or venue, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep2.png" class="image"
		title="reportsstep2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep2.png" border="1px"
		align="center"> </a> <BR>
	<BR> Now when you hit the <B>Submit</B> button, you will see a report like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep2-2.png" class="image"
		title="reportsstep2-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep2-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep2-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep2-2.png" border="1px"
		align="center"> </a> <BR>
		
	<BR> Note: if you wish to view the volunteer hours for all active and archived calendar weeks, 
	you don't need to select a date range or venue - just hit the <B>Submit</B> button. <BR>
	
<p>
	<B>Step 3:</B> If you wish to view the total number of volunteer shifts and vacancies, select "Shifts/Vacancies" and  
	pick a specific date range, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep3.png" class="image"
		title="reportsstep3.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep3.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep3.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep3.png" border="1px"
		align="center"> </a> <BR>
	<BR> Hitting <B>Submit</B> will now give you a report like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep3-2.png" class="image"
		title="reportsstep3-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep3-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep3-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep3-2.png" border="1px"
		align="center"> </a> <BR>
		
<p>
	<B>Step 4:</B> If you wish to view the volunteer birthday report, select "Volunteer Birthdays,"  like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep4.png" class="image"
		title="reportsstep4.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep4.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep4.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep4.png" border="1px"
		align="center"> </a> <BR>

	<BR> You will see a report like this (ordered by age -- oldest first): <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep4-2.png" class="image"
		title="reportsstep4-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep4-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep4-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep4-2.png" border="1px"
		align="center"> </a> <BR>
		
    <BR> Note that the date range does not come into play for the birthdays report. <BR>
<p>
	<B>Step 5:</B> If you wish to view a report of each volunteer's work history, select "Volunteer History" 
	and then click on <B>Submit</B> button, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep5.png" class="image"
		title="reportsstep5.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep5.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep5.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep5.png" border="1px"
		align="center"> </a> <BR>
	<BR> You will see a report like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep5-2.png" class="image"
		title="reportsstep5-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep5-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep5-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep5-2.png" border="1px"
		align="center"> </a> <BR>
	<br>The history report can be refined so that only the hours logged during a particular date range or venue
	can be viewed.  So, for example, volunteer hours logged for the month of April 2015 can be reported
	separately by picking a "from" date of April 1 and a "to" date of April 30. 
<p>
	<B>Step 6:</B> If you wish to view all the contact information of all volunteers in the database, 
	select "Volunteer Contact Info", and then just click on <B>Submit</B> button, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep6.png" class="image"
		title="reportsstep6.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep6.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep6.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep6.png" border="1px"
		align="center"> </a> <BR>
	<BR> You will see a report like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep6-2.png" class="image"
		title="reportsstep6-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep6-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep6-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep6-2.png" border="1px"
		align="center"> </a> <BR>
<p>
	<B>Step 7:</B> For the reporss described in Steps 4-6, you can also download them as .csv files 
	for processing as an Excel or OpenOffice spreadsheet.  To do this, checking the box on the right and 
	then hit <b>Submit</b> again. 
	For more discussion of this option, please look <a href="?helpPage=rmhp-homebase/dataExport.inc.php">here. 