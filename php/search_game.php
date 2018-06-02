<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style/indexStyle.css">
	<title>Social Gamer - Search for Games</title>
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

<main id="main">
	<div class="container slide-in-left">
		<h1 class="main-headline">Buscar jogo</h1>

		<form class="form" action="search_game.php" method="get">
		<p>Type a game name to search the database, or <a href="add_game.php">add your own</a>:</p>
		<input class="form__text" type="text" name="gamename" placeholder="Nome do jogo"></p>
		<input class="form__btn --size-sm" type="submit" value="Search">	
		
		<?php
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					if (isset($_GET["gameID"]) && !empty($_GET["gameID"])) {
						$gameToAddID = $_GET["gameID"];
						$query = "INSERT INTO owned_games (gameID, userID) VALUES ('".$gameToAddID."' , '".$userid."')";
						$result = $conn->query($query);
						echo "<Br>Game sucessfully added!";
						

						$query = "INSERT INTO tags(userID, gameID, tag) VALUES ('".$userid."', '".$gameToAddID."', 'Playing')";
						$result = $conn->query($query);
						echo "<br>Game was added with the tag Playing. If you wish, you can change its tag on your dashboard.";					
					}

					if (isset($_GET["gamename"]) && !empty($_GET["gamename"])) {
						$gamename = $_GET["gamename"];
						$query = "SELECT * FROM game WHERE gname LIKE \"%".$gamename."%\"";
						$result = $conn->query($query);
						echo "<br>Games found:";
						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
							echo "<p><form action=\"search_game.php\" method=\"get\">".$row["gname"]." <button name=\"gameID\" type=\"submit\" value=\"".$row["gameID"]."\"> Add</button></form></p>";
							}
						}
					$conn->close();
					}
				}

				catch(Exception $e)
				{
					echo $e->getMessage();
				}

		?>
		<p><a href="user_page.php">Back to User Page</a>		
	</div>
</main>

<?php 
	include 'modules/footer.php';
?>