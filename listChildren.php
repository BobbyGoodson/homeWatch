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
?>
<html>
    <head>
        <title>
            List of Children
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>
        	#appLink:visited {
        		color: gray; 
        	}

			table, th, td {
			text-align: center;
			border: 1px solid black;
			border-collapse: collapse;
			}

			th {
			font-size: 25px;
  			background-color: #b9a1e8;
			}

			td {
			font-size: 20px;
			background-color: #ddd2f4;
			}
		</style> 
    </head>
    <body>
        <div id="container">
            <?PHP include('header.php'); ?>
            <div id="content">

				<p style="text-align:center"><strong>List of Children</strong><br /><br />
				<table style="width:100%" align = "center" name = "Children">
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>DOB</th>
						<th>Health Requirements</th>
					</tr>
					<?php
					$guardianEmail = $_GET['guardianID'];
					$con=connect();
					// query dbChildren to select all children with parent email address = 'email of guardian'
					$query = "SELECT id, first_name, last_name, DOB, health_requirements FROM dbChildren where parent_email = '$guardianEmail'";
					$result = mysqli_query($con,$query);
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<tr>';
							echo '<td>' . $row['first_name'] . '</td>';
							echo '<td>' . $row['last_name'] . '</td>';
							echo '<td>' . $row['DOB'] . '</td>';
							echo '<td>' . $row['health_requirements'] . '</td>';
							echo '</tr>';
						}
					}
					?>
				</table>
			</div>
		</div>
	</body>
</html>