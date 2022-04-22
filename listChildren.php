<?php
/*
 * listChildren.php
 * List all children for each guardian
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

				<p style="text-align:center"><strong>List of Children</strong><br /><br />
				<table align = "center" class = "main">
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
					$query = "SELECT id, first_name, last_name, DOB, health_requirements FROM dbChildren WHERE parent_email = '$guardianEmail'";
					$result = mysqli_query($con,$query);
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<tr>';
							echo '<td><center>' . $row['first_name'] . '</center></td>';
							echo '<td><center>' . $row['last_name'] . '</center></td>';
							echo '<td><center>' . $row['DOB'] . '</center></td>';
							echo '<td><center>' . $row['health_requirements'] . '</center></td>';
							echo '</tr>';
						}
					}
					?>
				</table>
			</div>
		</div>
	</body>
</html>