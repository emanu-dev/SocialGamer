<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Game Details</title>
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
			<h3>Game Details</h3>
			<?php

				try {
					$gameid = $_GET["gameID"];
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}
					$query = "SELECT game.gameID, game.gname, game.publisher, game.rating, game.consolename, console.consoleID, console.cname FROM game INNER JOIN console ON game.consolename=console.consoleID WHERE game.gameID=\"".$gameid."\"";

					$result = $conn->query($query);

					if ($row = $result->num_rows > 0)
					{
							while($row = $result->fetch_assoc()) 
							{
							echo "<h2>".$row["gname"]."</h2>";
							echo "by <i>".$row["publisher"]."</i>";
							echo "<br>Rating: <br>";
							$rating = $row["rating"];
							if ($rating == "e"){
								echo "<img src='images/ratingsymbol_e.png' alt='Rated E for Everyone'>";
							}
								
							if ($rating == "t")
								{echo "<img src='images/ratingsymbol_t.png' alt='Rated T for Teens'>";}
							if ($rating == "m")
								{echo "<img src='images/ratingsymbol_m.png' alt='Rated M for Mature'>";}
							if ($rating == "a")
								{echo "<img src='images/ratingsymbol_ao.png' alt='Rated Ao for Adults Only'>";}
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
			<p><b>Recommendations: </b><br></p>
			<div id="fixedBox">
				<?php
					try {
						$gameid = $_GET["gameID"];
						$conn = new mysqli($url, $username, $password, $dbname);

						if ($conn->connect_error) {
							throw new Exception($conn->connect_error);
						}else {
							
						}
						$query = "SELECT game.gameID, game.gname, recommendation.gameID, recommendation.userID, recommendation.rec FROM recommendation INNER JOIN game ON recommendation.gameID=game.gameID WHERE recommendation.gameID='".$gameid."';";
							
						$result = $conn->query($query);

						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								echo "<p><b>Game:</b> ".$row["gname"]."<br> <b>Recommendation:</b> <i>".$row["rec"]."</i></p>";
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
			<p><a href="user_page.php">Back to User Page</a>
		</div>
	</div>
</body>
</html>