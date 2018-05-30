<?php			

	$local = array('127.0.0.1', '::1');
	$url = 'localhost:3306';
	$password = '';
	$username = '';
	$dbname = '';			
	$query ='';

	if (in_array($_SERVER['REMOTE_ADDR'], $local)) {
		$url = "localhost:3306";
		$password = "";
		$username = "root";
		$dbname = "comp5000";		
	}else {
		$url = "mysql427.umbler.com";
		$password = "socialgamer";
		$username = "wegamr";
		$dbname = "wegamr-data";
		$query;
	}
?>