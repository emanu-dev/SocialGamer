<?php 
	include 'modules/head.php';
?>
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
		<div class="container">
			<h1 class="main-headline">Adicionar Jogo</h1>
			<?php
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					if (isset($_GET["gamename"]) && !empty($_GET["gamename"])) {
						$gamename = $_GET["gamename"];
						$publisher = $_GET["publisher"];
						$rating = $_GET["rating"];
						$console = $_GET["consoleid"];
						
						$query = "INSERT INTO game (gname, publisher, rating, consolename) VALUES ('".$gamename."', '".$publisher."' , '".$rating."' , '".$console."')";
					
						$result = $conn->query($query);
						echo "<br><br>Game added to the database. Now you can go back to the search page and add it to your library.";					
					}else{
						$query = "SELECT consoleID, cname FROM console";
						$result = $conn->query($query);

						echo "<br><form class=\"form\" action=\"add_game.php\" method=\"get\">";
						echo "<input class=\"form__text\" type=\"text\" name=\"gamename\" placeholder=\"Game Name\"> ";
						echo "<input class=\"form__text\" type=\"text\" name=\"publisher\" placeholder=\"Publisher\">";
						echo "<p>Rating:  <select name=\"rating\"><option value=\"e\">E for Everyone</option><option value=\"t\">Teen +13</option><option value=\"m\">Mature +17</option><option value=\"a\">Adults Only +21</option></select></p>";
						echo "<p>Console: <select name=\"consoleid\">";

						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								$name = $row["cname"];
								$value = $row["consoleID"];
								echo "<option value=\"".$value."\">".$name."</option>";
							}
						}
						echo "</select></p>";
						echo "<input class=\"form__btn --size-sm\" type=\"submit\" value=\"Submit\">";
					}

					$conn->close();
				}
				catch(Exception $e)
				{
					echo $e->getMessage();
				}
			?>
			<p><a href="search_game.php">Back to Search Game Page</a>
			<p><a href="user_page.php">Back to User Page</a>
		</div>
	</main>
</body>
</html>