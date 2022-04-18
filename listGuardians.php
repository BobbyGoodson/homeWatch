<?php
/*
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
			select {
    			padding:5px; 
    			background:#428BCA; 
    			cursor:pointer;
    			font-size:24px;
    			color: 	#ffffff;
			}
		</style> 
    </head>
    <body>
        <div id="container">
            <?PHP include('header.php'); ?>
            <div id="content">
				<?PHP
				//A table that lists the results of guardian accounts
				function list_table($result){
					echo '<table align = "center" class = "main">
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Barcode</th>
							<th>Children</th>
						</tr>';
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
					echo '</table>';
				}

				echo '<p style="text-align:center"><strong>List of Guardians</strong><br /><br />';

				//The Search bar and button
				echo '<table align = "center">';
					echo '<tr><form>';
						echo '<td><select name="searchOption" id="searchOption">';
							echo '<option value="id">Email</option>';
							echo '<option value="last_name">Last Name</option>';
							echo '<option value="first_name">First Name</option>';
							echo '<option value="barcode">Barcode</option>';
						echo ' </select></td>';
						echo '<td><input type="text" name="search_query"></td>';
						echo '<td><input type="submit" value="Search" name="Search"></td>';
					echo '</form></tr>';
				echo' </table><br /><br />';

				$search = $_GET['search_query'];
				$option = $_GET['searchOption'];
				if ($search == NULL){
					$con=connect();
					// query through dbPersons to select all people with position = 'guardian'
					$query = "SELECT id, first_name, last_name, phone, email, barcode FROM dbPersons WHERE position = 'guardian' ORDER BY id";
					$result = mysqli_query($con,$query);
					list_table($result);
				} else {
					//table with the results from search, the search button has been pressed
					$result = search_person($search, $option);
					if ($result == false){
						echo 'No results found.';
					} else {
						list_table($result);
					}
				}
				?>
			</div>
		</div>
	</body>
</html>