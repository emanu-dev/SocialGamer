<?php			

	$local = array('127.0.0.1', '::1');

	if (in_array($_SERVER['REMOTE_ADDR'], $local)) {
		echo 'in localhost';
	}	
	
	$url = "localhost:3306";
	$password = "";
	$username = "root";
	$dbname = "comp5000";
	$query;
?>