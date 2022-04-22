<?php
/*
 * removeChild.php
 * Remove child from guardian account
 */

session_start();
session_cache_expire(30);
?>
<html>
    <head>
        <title>
            Removing a child
        </title>
    </head>
    <body>
        <?php
        include_once('database/dbChildren.php');

        if ($_SESSION['_id'] != $_GET['id']){
            //entered this page without being logged in as the child's user
            echo('You do not have the permissions to perform this action');
        } else if (!isset($_GET['id']) || !isset($_GET['first_name']) || !isset($_GET['last_name'])) {
            //Entered this page without the correct url
            echo('Cannot perform action.');
        } else {
            //we may perform
            $childID = $_GET['first_name'] . "*" . $_GET['last_name'] . "*" . $_GET['id'];
            remove_child($childID);
        }
        header("Location: http://localhost/homeWatch/personEdit.php?id=" . $_GET['id'] . "");
        ?>
	</body>
</html>