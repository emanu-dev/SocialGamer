<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<link rel="stylesheet" type="text/css" href="style/indexStyle.css">
	<title>Social Gamer - Add Console</title>
</head>
<body>
	<?php 
		include 'db_conn_var.php';
	?>

	<?php
		if (isset($_SESSION["logged_userID"])) {
			$userid = $_SESSION["logged_userID"];
		}else {
			$url="index.php?status=notlogged";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
		}
	?>
	
	<div id="header">
		<img src="user.png" width="37px" height="37px"><?php
			try {
				
				$conn = new mysqli($url, $username, $password, $dbname);

				if ($conn->connect_error) {
					throw new Exception($conn->connect_error);
				}else {
					
				}

				$query = "SELECT * FROM user WHERE userID='".$userid."'";
				$result = $conn->query($query);

				if ($row = $result->num_rows > 0)
				{
					while($row = $result->fetch_assoc()) 
					{
						echo $row["username"];
						$date = strtotime($row["dob"]);
						$final_dob = date("M/d/y", $date);
						?>
						<img src="calendar.png" width="37px" height="37px" >
						<?php
						echo "Birth: ".$final_dob;
					}
				}

				$conn->close();	
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}?>

		<a href="index.php?status=logout" style="float: right;">Logout</a>
	</div>
	
	<div id="signBox">
		<h1>Add Console</h1><br>
		<?php

			$consolename = null;
			$manufacturer = null;
			
			if (isset($_GET["cname"])) {
				$consolename = $_GET["cname"];
				$manufacturer = $_GET["manufacturer"];
			}
			

			if ($consolename != null)
			{
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}
					
					$query = "INSERT INTO console (cname, manufacturer) VALUES ('".$consolename."', '".$manufacturer."')";
					$result = $conn->query($query);
					echo "<br>Console added to the database. Now you can go back to the search page and add it to your library.";
					
					$conn->close();	
				}
				catch(Exception $e)
				{
					echo $e->getMessage();
				}
			}else{
				echo "<form action=\"add_console.php\" method=\"get\">";
				echo "<input type=\"text\" name=\"cname\" placeholder=\"Console Name\">";
				echo "<input type=\"text\" name=\"manufacturer\" placeholder=\"Manufacturer\">";
				echo "</select></p>";
				echo "<input type=\"submit\" value=\"Submit\">";
		}
		?>
		<p><a href="search_console.php">Back to Search Console Page</a>
		<p><a href="user_page.php">Back to User Page</a>
	</div>
</body>
</html>