<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5.0 Transitional//EN">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<link rel="stylesheet" type="text/css" href="style/indexStyle.css">
	<title>Social Gamer - Add Recommendation</title>
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
	
	<?php 
		include 'header.php';
	?>
	
	<div id="signBox">
		<h1>Add Recommendation</h1><br><br>
		<form action="add_recommendation.php" method="get">
		<p>Game to reccomend:
		<select name="gameID">
		<?php
			try {
				$conn = new mysqli($url, $username, $password, $dbname);

				if ($conn->connect_error) {
					throw new Exception($conn->connect_error);
				}else {
					
				}
				
				$query = "SELECT game.gameID, game.gname, owned_games.gameID, owned_games.userID FROM owned_games INNER JOIN game ON owned_games.gameID=game.gameID WHERE owned_games.userID='".$userid."';";
				$result = $conn->query($query);

				if ($row = $result->num_rows > 0)
				{
					while($row = $result->fetch_assoc()) 
					{
						$gvalue = $row["gameID"];
						$gname = $row["gname"];
						echo "<option value='".$gvalue."'>".$gname."</option>";
					}
				}
				
				$conn->close();
				}
				catch(Exception $e)
				{
					echo $e->getMessage();
				}
		?>
		<input type="text" name="rec" placeholder="Write Recommendation">
		<input type="submit" value="Confirm">
		</form>

		<?php


			if (isset($_GET["gameID"])) {

				$gameid = $_GET["gameID"];
				$rec = $_GET["rec"];
				
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}
					$query = "INSERT INTO recommendation(userID, gameID, rec) VALUES ('".$userid."','".$gameid."','".$rec."')";
					$result = $conn->query($query);
					echo "<br>Recommendation was added with success";
					$conn->close();
				}
				catch(Exception $e)
				{
					echo $e->getMessage();
				}
			}
		?>
		<p><a href="user_page.php">Back to User Page</a>
	</div>
</body>
</html>