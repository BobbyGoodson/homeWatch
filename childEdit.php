<?php
/*
 * 	childEdit.php
 *  Add's children to database
 */
session_start();
session_cache_expire(30);
include_once('database/dbPersons.php');
include_once('domain/Person.php');

//obtain the guardian to which this child is being added to
$id = str_replace("_"," ",$_GET["id"]);

?>
<html>
    <head>
        <title>
            Adding Child
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
    </head>
    <body id="bodyForm">
            <div id="formPerson">
                <?PHP
                //include('personValidate.inc');
                if ($_POST['_submit_child'] != 1){
                    //in this case, the form has not been submitted, so show it
                    include('childForm.inc');
                } else {
                    echo('hey');
                    //in this case, the form has been submitted, so validate it

                    // LASTLY: this was a successful form submission; update the database and exit
                    //process_child($id,$person);

                    //go back to the guardians update account page
                    echo "<script type=\"text/javascript\">window.location = \"personEdit.php?"  . $_SESSION['_id'] . "\";</script>";
                }

                
                /**
                 * process_form sanitizes data, concatenates needed data, and enters it all into a database
                 */
                function process_child($id,$person) {
                    //Process the form
                    echo('hey');
                }
                ?>
            </div>
    </body>
</html>
