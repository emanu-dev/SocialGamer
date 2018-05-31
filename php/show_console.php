<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<link rel="stylesheet" type="text/css" href="style/indexStyle.css">
	<title>Social Gamer - Console Details</title>
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
		<div class="side">
			<h3>Console Details</h3>
			<?php

				try {
					$consoleid = $_GET["consoleID"];
					
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					$query = "SELECT * FROM console WHERE console.consoleID='".$consoleid."'";
					$result = $conn->query($query);

					if ($row = $result->num_rows > 0)
					{
						while($row = $result->fetch_assoc()) 
						{
							echo "<h1>".$row["cname"]."</h1><br>";
							echo "by <i>".$row["manufacturer"]."</i>";
						}
					}

					$conn->close();
				}
				catch(Exception $e)
				{
					echo $e->getMessage();
				}
			?>
		</div>

		<div class="side">
			<p>Games registered for this console: <br></p>
			<div id="fixedBox">
				<?php
					try {
						$consoleid = $_GET["consoleID"];
	
						$conn = new mysqli($url, $username, $password, $dbname);

						if ($conn->connect_error) {
							throw new Exception($conn->connect_error);
						}else {
							
						}
						$query = "SELECT game.gameID, game.gname, game.publisher, game.rating, game.consolename, console.consoleID, console.cname FROM game INNER JOIN console ON game.consolename=console.consoleID WHERE console.consoleID=\"".$consoleid."\"";
	
						$result = $conn->query($query);

						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								echo "<a href=\"show_game.jsp?gameID=".$row["gameID"]."\">".$row["gname"]."</a><br>";
							}
							$conn->close();
						}
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
			</div>
			<p><a href="user_page.php">Back to User Page</a>
		</div>
	</div>
</body>
</html>