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
include_once('database/dbinfo.php');
include_once('database/dbPersons.php')
?>
<html>
    <head>
        <title>
            List of Guardians
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>
			table.main { border-collapse:collapse; font-family:verdana, arial, sans-serif; 
				background: white; width: 65%; margin-left: auto; margin-right: auto; }
			table.main td { border: 1px solid #D3D3D3; font-size:24px; padding:10px; }
			table.main thead {background-color: white; }
			table.main th { border: 1px solid #D3D3D3; font-size:24px; padding:10px; color: #808080; }
		</style> 
    </head>
    <body>
        <div id="container">
            <?PHP include('header.php'); ?>
            <div id="content">

				<p style="text-align:center"><strong>List of Guardians</strong><br /><br />
				<table align = "center" class = "main">
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Barcode</th>
						<th>Children</th>
					</tr>
					<?php
					$con=connect();
					// query through dbPersons to select all people with position = 'guardian'
					$query = "SELECT id, first_name, last_name, phone, email, barcode FROM dbPersons WHERE position = 'guardian'";
					$result = mysqli_query($con,$query);
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
						 	$guardianEmail = $row['id'];
							$phone = $row['phone'];
							$formatted_phone = phone_edit($phone);
							echo '<tr>';
							echo '<td><center>' . $row['first_name'] . '</center></td>';
							echo '<td><center>' . $row['last_name'] . '</center></td>';
							echo '<td><center>' . $formatted_phone . '</center></td>';
							echo '<td><center>' . $row['email'] . '</center></td>';
							echo '<td><center>' . $row['barcode'] . '</center></td>';
							echo '<td><center><a style="font-weight:bold; color: #428BCA; font-size: 24px; width:100%" href="' . $path . 'listChildren.php?guardianID=' . $guardianEmail. '">View Children</a></center></td>';
							echo '</tr>';
						}
					}
					?>
				</table>
			</div>
		</div>
	</body>
</html>