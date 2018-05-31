<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<link rel="stylesheet" type="text/css" href="style/indexStyle.css">
	<title>Social Gamer - Edit Tags</title>
</head>
<body>

	<?php 
		include 'db_conn_var.php';
		$userid;
		$edited;		
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
		<h1>Edit Tags</h1><br>
		<p>Your games: <br>
		<?php
				
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}					
					
					if (isset($_GET["edit"]))
					{
						$edited = $_GET["edit"];
						$gameid = $_GET["gameID"];
						$tag = $_GET["tag"];
						
						$query = "UPDATE tags SET tag='".$tag."' WHERE userID='".$userid."' AND gameID='".$gameid."'";
						$result = $conn->query($query);
						echo "<br><b>Tag updated!</b>";	
					}else{	
						$query = "SELECT game.gameID, game.gname, owned_games.gameID, owned_games.userID FROM owned_games INNER JOIN game ON owned_games.gameID=game.gameID WHERE owned_games.userID='".$userid."';";
						$result = $conn->query($query);

						echo "<form action='edit_tags.php' method='get'>";
						echo "<input type='hidden' name='edit' value='1'>";
						echo "<p>Your Games:";
						echo "<select name='gameID'>";

						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								$gvalue = $row["gameID"];
								$gname = $row["gname"];
								echo "<option value='".$gvalue."'>".$gname."</option>";
							}
						}
						echo "</select>";
						echo "<p>Tag to apply:";
						echo "<select name='tag'>";
						echo "<option value='Playing'>Playing</option>";
						echo "<option value='Finished'>Finished</option>";
						echo "<option value='OnBacklog'>OnBacklog</option>";
						echo "</select><br><br><Br>";
						echo "<input type='submit' value='Save'>";
					}
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