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
			  content: function(){return '<img border="3" src="'+$(this).data('img') + '" width="50%"/>';}
			});
	});
</script>

<p>
	<strong>How to Add People to the Database</strong>
<p>
	<B>Step 1:</B> On the navigation bar at the top of the page, find <B>volunteers:</B>
	and select <B>add</B>, like this:<BR> <BR> <a
		href="tutorial/screenshots/addpersonhelpstep1.png" class="image"
		title="addpersonhelpstep1.png" horizontalalign="center"
		target="tutorial/screenshots/addpersonhelpstep1.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addpersonhelpstep1.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/addpersonhelpstep1.png"
		border="1px" align="center"> </a>
<p>
	<B>Step 2:</B> You should now see a long form with information like
	"First Name" and "Last Name". That form begins like this:<BR> <BR> <a
		href="tutorial/screenshots/addpersonhelpstep2.png" class="image"
		title="addpersonhelpstep2.png"
		target="tutorial/screenshots/addpersonhelpstep2.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addpersonhelpstep2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/addpersonhelpstep2.png"
		border="1px" align="middle"> </a> <BR><BR> Now you can fill in these
		fields with the correct information. <BR><BR>(NOTE:&nbsp All fields marked
		by <font color="#FF0000">*</font> are required before a person can be
	added to the database.)
</p>

<p>
	<B>Step 3:</B> For date fields, a menu will pop up allowing you to select a date:<BR> <BR> <a
		href="tutorial/screenshots/addpersonhelpstep3.png" class="image"
		title="addpersonhelpstep3.png"
		target="tutorial/screenshots/addpersonhelpstep3.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addpersonhelpstep3.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/addpersonhelpstep3.png"
		border="1px" align="middle"> </a>
</p>

<p>
	<B>Step 4:</B> Beneath this form you should see a section marked <B>Availability</B>. 
		Here you can highlight different shifts depending on the volunteer's 
		availibility:<BR> <BR> <a
		href="tutorial/screenshots/addpersonhelpstep4.png" class="image"
		title="addpersonhelpstep4.png"
		target="tutorial/screenshots/addpersonhelpstep4.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addpersonhelpstep4.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/addpersonhelpstep4.png"
		border="1px" align="middle"> </a> <BR><BR> You can highlight multiple shifts at a time 
		by clicking and dragging (<font color=#666666>Gray</font> or <font color=#0033ff>blue</font> 
		shading indicates a shift is selected). NOTE: If a volunteer is availible 
		all weeks of the month it is easier to fill out only the shifts for odd and 
		even than to select all of the shifts in the lower portion.
</p>

<p>
	<B>Step 5:</B> When you're finished entering information, select the <B>Submit</B> button at the
	bottom of the page, like this:<BR> <BR> <a
		href="tutorial/screenshots/addpersonhelpstep5.png" class="image"
		title="addpersonhelpstep5.png"
		target="tutorial/screenshots/addpersonhelpstep5.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addpersonhelpstep5.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/addpersonhelpstep5.png"
		border="1px" align="middle"> </a>
<p>
	<B>Step 6:</B> If you make a mistake or omit a required field, <font
		color=#FF0000>red</font> warnings will tell you what you need to
	correct, like this:<BR> <BR> <a
		href="tutorial/screenshots/addpersonhelpstep6.png" class="image"
		title="addpersonhelpstep6.png" horizontalalign="center"
		target="tutorial/screenshots/addpersonhelpstep6.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addpersonhelpstep6.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/addpersonhelpstep6.png"
		border="1px" align="middle"> </a> <BR><BR>After you make these
		corrections, repeat <B>Step 5</B>.
<p>
	<B>Step 7:</B> If you have no errors or omissions, you will see a page
	that looks like this:<BR> <BR> <a
		href="tutorial/screenshots/addpersonhelpstep7.png" class="image"
		title="addpersonhelpstep7.png" horizontalalign="center"
		target="tutorial/screenshots/addpersonhelpstep7.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addpersonhelpstep7.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/addpersonhelpstep7.png"
		border="1px" align="middle"> </a>
<p>
	<B>Step 8:</B> When you finish, you can return to any other function by
	selecting it on the navigation bar.