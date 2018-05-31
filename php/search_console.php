<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<link rel="stylesheet" type="text/css" href="style/indexStyle.css">
	<title>Social Gamer - Search for Consoles</title>
</head>
<body>
	<?php 
		include 'db_conn_var.php';
		$userid;
	?>

	<?php
		if (isset($_SESSION["logged_userID"])) {
			$userid = $_SESSION["logged_userID"];
		}else {
			$url="index.php?status=notlogged";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
		}
	?>	
	
	<?php 
		include 'header.php';
	?>
	
	<div id="signBox">
		<h1>Search for Console</h1><Br>
		
		<form action="search_console.php" method="get">
		<p>Type a game name to search the database, or <a href="add_console.php">add your own</a>:
		<input type="text" name="cname" placeholder="Console Name"></p>
		<input type="submit" value="Search">	
		<?php

			$consolename = null;
			$consoleToAddID = null;

			try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					if (isset($_GET["consoleID"]) && !empty($_GET["consoleID"])) {
						$consoleToAddID = $_GET["consoleID"];
						$query = "INSERT INTO owned_consoles (consoleID, userID) VALUES ('".$consoleToAddID."' , '".$userid."')";
						$result = $conn->query($query);
						echo "<br>Console sucessfully added!";						
					}

					if (isset($_GET["cname"]) && !empty($_GET["cname"])) {
						$consolename = $_GET["cname"];
						$query = "SELECT * FROM console WHERE cname LIKE \"%".$consolename."%\"";
						$result = $conn->query($query);
						
						echo "<br>Consoles found:";
						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								echo "<p><form action=\"search_console.php\" method=\"get\" >".$row["cname"]." <button name=\"consoleID\" type=\"submit\" value=\"".$row["consoleID"]."\"> Add</button></form></p>";
							}
						}						
					}

					$conn->close();
				}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
		?>
		<p><a href="user_page.php">Back to User Page</a>
	</div>
</body>
</html>