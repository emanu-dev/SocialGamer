<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="userStyle.css">
	
	<title>Social Gamer - User Dashboard</title>
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

	<div id="box">
		<h3> User Details</h3>
			<div id="username">
				<?php
				try {
					
					$userid = $_SESSION["logged_userID"];

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
							echo "<br><h1>".$row["username"]."</h1>";
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
			
			<div id="consoles">
				Your owned consoles: <br> 
				<?php
					try {
						
						$userid = $_SESSION["logged_userID"];

						$conn = new mysqli($url, $username, $password, $dbname);

						if ($conn->connect_error) {
							throw new Exception($conn->connect_error);
						}else {
							
						}
						
						$query = "SELECT console.consoleID, console.cname, owned_consoles.consoleID, owned_consoles.userID FROM owned_consoles INNER JOIN console ON owned_consoles.consoleID=console.consoleID WHERE owned_consoles.userID=".$userid.";";
						
						$result = $conn->query($query);

						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								echo "<a href=\"show_console.php?consoleID=".$row["consoleID"]."\">".$row["cname"]."</a> - ";
							}
						}
						$conn->close();
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?><br>
				<FORM METHOD="LINK" ACTION="search_console.php">
				<INPUT TYPE="submit" VALUE="Add New One"></FORM>
			</div>
		
			<div id="library">
				Game Library: <br> 
				<div class="fixedMenu">
					<?php
						try {
							
							$userid = $_SESSION["logged_userID"];

							$conn = new mysqli($url, $username, $password, $dbname);

							if ($conn->connect_error) {
								throw new Exception($conn->connect_error);
							}else {
								
							}

							$query = "SELECT game.gameID, game.gname, owned_games.gameID, owned_games.userID, tags.gameID, tags.tag, tags.userID FROM owned_games INNER JOIN game ON owned_games.gameID=game.gameID INNER JOIN tags ON game.gameID=tags.gameID WHERE owned_games.userID='".$userid."';";
							
							$result = $conn->query($query);

							echo "<table id=\"gameTable\">";
							echo "<tr><th>Name</th><th>Tagged as</th></tr>";
						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								echo "<tr>";
								echo "<td><a href=\"show_game.php?gameID=".$row["gameID"]."\">".$row["gname"]."</a></td>";
								echo "<td>".$row["tag"]."</td>";
								echo "</tr>";
							}
						}
							echo "</table>";
							
							$conn->close();
						}
						catch(Exception $e)
						{
							echo $e->getMessage();
						}
					?>
				</div><br>
				<FORM METHOD="LINK" ACTION="search_game.php">
				<INPUT TYPE="submit" VALUE="Add New Game"></FORM>
				<FORM METHOD="LINK" ACTION="edit_tags.php">
				<INPUT TYPE="submit" VALUE="Edit Tags"></FORM>
			</div>
			
			<div id="friends">
				Friends: <br> 
				<div class="fixedMenu">
					<?php
						try {
							
							$userid = $_SESSION["logged_userID"];

							$conn = new mysqli($url, $username, $password, $dbname);

							if ($conn->connect_error) {
								throw new Exception($conn->connect_error);
							}else {
								
							}

							$query = "SELECT f.friendID, f.requesterID, fu.username as fu_name, ru.username as ru_name, f.accepted FROM friend f INNER JOIN user fu ON fu.userID = f.friendID INNER JOIN user ru ON ru.userID = f.requesterID WHERE (f.requesterID=".$userid." OR f.friendID=".$userid.") AND f.accepted=1;";
							
							$result = $conn->query($query);


							if ($row = $result->num_rows > 0)
							{
								while($row = $result->fetch_assoc()) 
								{
									if (intval($row["f.friendID"]) == intval($userid))
									{
										echo "<a href=\"show_user.php?friendID=".$row["f.requesterID"]."\">".$row["ru_name"]."</a><br>";
									}else{
										echo "<a href=\"show_user.php?friendID=".$row["f.friendID"]."\">".$row["fu_name"]."</a><br>";
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
				</div><br>
				<FORM METHOD="LINK" ACTION="search_friend.php">
				<INPUT TYPE="submit" VALUE="Add Friends"></FORM>
				<FORM METHOD="LINK" ACTION="friend_requests.php">
				<INPUT TYPE="submit" VALUE="Friend Requests"></FORM>
			</div>
		
		<div style="clear:both"></div>
		<div id="footer">
			Recommendations: <br> 
			<div id="recommendation">
				<?php
					try {

						$userid = $_SESSION["logged_userID"];

						$conn = new mysqli($url, $username, $password, $dbname);

						if ($conn->connect_error) {
							throw new Exception($conn->connect_error);
						}else {
							
						}
						
						$query = "SELECT game.gameID, game.gname, recommendation.gameID, recommendation.userID, recommendation.rec FROM recommendation INNER JOIN game ON recommendation.gameID=game.gameID WHERE recommendation.userID='".$userid."';";
						
						$result = $conn->query($query);

						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								echo "<p><b>Game</b>: ".$row["gname"]."<br> Your Recommendation: <i>".$row["rec"]."</i></p>";
							}
						}
						$conn->close();
					}
						catch(Exception $e)
						{
							echo $e->getMessage();
						}
				?>
			</div><br>
			<FORM align="right" METHOD="LINK" ACTION="add_recommendation.php">
			<INPUT TYPE="submit" VALUE="Add Recommendation"></FORM>
		</div>
	</div>
</body>
</html>