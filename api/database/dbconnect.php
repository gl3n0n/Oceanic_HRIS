<?php
$host="localhost"; // Host name
$username="oceanic"; // Mysql username
$password="oceanic"; // Mysql password
$db_name="oceanic"; // Database name
//$tbl_name="rp_admin"; // Table name

// Connect to server and select database.
mysql_connect($host, $username, $password)or die("Cannot Connect");
mysql_select_db($db_name)or die("Cannot select DB!");

?>