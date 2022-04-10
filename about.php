<?php
/*
 * Copyright 2015 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

session_start();
session_cache_expire(30);
?>
<html>
	<head>
		<title>
			About
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
				<p style="text-align:center"><strong>About Us</strong></p>
				<p>
				We are the Child Watch Program for the YMCA in the Rappahannock Area. 
				As the name suggests, we are able to watch your children while you are doing some other activity at the YMCA facility.
				We can supervise your children for up to 2 hours while you are allowed to go relax doing whatever, as long as you are on premises of the YMCA facility. 
				There is no charge for this and as long as you are an existing member of the YMCA, you are able to sign up for this program through our website. 
				Once you are signed up, you can add children to your account and reserve a time slot for your children 24-hours in advance. 
				<br /><br />
				</p>

				<p style="text-align:center"> <strong> Additional Information</strong></p>
				<p>
				As long as your child is between the ages of 6 weeks through 12 years old, you can reserve any available time slot to allow them to be watched while your are working out, swimming, or doing any other activity at the gym. 
				As long as you are in the building, you can drop off your child at the Child Watch Program at the YMCA facility. 
				If you have multiple children between the specified ages, and you want to reserve an available time slot for each of them, feel free to do that as well.
				The maximum amount of time each child can be watched for is 2 hours, so make it count!
				If you want to enjoy your time at the YMCA while not having to worry about your children, sign up now!
				</p>
			</div>
		<?PHP include('footer.inc');?>
		</div>
	</body>
</html>
