<?php
//phpinfo();
ini_set('smtp_port',465);
$result = mail('ymcacreateaccount@yahoo.com','Test Email','This is a test','From: ymcacreateaccount@yahoo.com');
var_dump($result);
?>