<?php

	// Start the session
	session_start();
	
	include 'db_conn_var.php';
	
	$userid = $_SESSION["logged_userID"];
	$friendId = $_GET['id'];


	try {
		$conn = new mysqli($url, $username, $password, $dbname);

		if ($conn->connect_error) {
			throw new Exception($conn->connect_error);
		}

		$query = "SELECT * FROM friend WHERE requesterid=" . intval($friendId) . " AND friendid=" . intval($userid) . " AND accepted=0";
		$result = $conn->query($query);

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()) 
			{
				echo " aceita";
				$query = "UPDATE friend SET accepted=1 WHERE requesterid=" . intval($friendId) . " AND friendid=" . intval($userid) . " AND accepted=0";
				mysqli_query($conn, $query);
			}
		}

	} catch (Exception $e) {
		
	}

?>