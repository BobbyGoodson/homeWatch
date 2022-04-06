<?php
/*
 * 	childEdit.php
 *  Add's children to database
 */
session_start();
session_cache_expire(30);
include_once('database/dbChildren.php');
include_once('domain/Child.php');
include_once('database/dbLog.php');

//obtain the guardian to which this child is being added to
//$id = str_replace("_"," ",$_GET["id"]);
//$child = new Child('Joe', 'Child', '07-06-2021', 'athsma', 'bob@gmail.com');

?>
<html>
    <head>
        <title>
            Adding Child
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>

        </style>
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
    </head>
    <body id="bodyForm">
            <div id="formperson">
                <?PHP
                include('personValidate.inc');
                if ($_POST['_submit_child'] != 1){
                    //in this case, the form has not been submitted, so show it
                    include('childForm.inc');
                } else {
                        process_child($child);
                        echo "<script type=\"text/javascript\">window.location = \"childEdit.php?"  . $_SESSION['_id'] . "\";</script>";  
                }
                
                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_child($child) {
                    //Process the form

                   $first_name = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['first_name']))));
                   $last_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['last_name'])));
                   $DOB = trim(str_replace('\\\'', '\'', htmlentities($_POST['DOB'])));
                   $health_requirements = trim(str_replace('\\\'', '\'', htmlentities($_POST['health_requirements'])));
                   $parent_email = $_SESSION['_id'];
			 
                   // child first name saved in session variable to be added to update account page
                   $_SESSION['child_first_name'] = $first_name;

                   $newchild = new Child($first_name, $last_name, $DOB, $health_requirements, $parent_email);
                   add_child($newchild);
                   
                   echo "<script type=\"text/javascript\">window.location = \"personEdit.php?"  . $_SESSION['_id'] . "\";</script>";           
                }
                ?>
            </div>
    </body>
</html>
