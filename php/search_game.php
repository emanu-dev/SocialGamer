<?php 
	include 'modules/head.php';
?>
<body>
	<?php 
		include 'db_conn_var.php';
		include_once 'modules/user.handler.php';
		include_once 'modules/games.handler.php';
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
			<p>Digite um nome para buscar no banco:
			<input class="form__text" type="text" name="keyword" placeholder="Nome do jogo"></p>
			<input class="form__btn --size-sm" type="submit" value="Buscar">
		</form>
		<?php
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					if (isset($_POST["guid"]) && !empty($_POST["guid"])) {

						$guid = $_POST["guid"];
						$gamename = $_POST["gamename"];
						$icon = $_POST["icon"];
						$picture = $_POST["picture"];
						$release = $_POST["release"];
						$rating = $_POST["rating"];
						$gameToAddID = "";
						
						echo $rating;

						$query = "SELECT gameId FROM games WHERE apiId ='" . $guid . "';";
						$result = $conn->query($query);

						if ($row = $result->num_rows == 0)
						{
							$stmt = $conn->prepare("INSERT INTO games (apiId, gname, icon, picture, release_date) VALUES (?, ?, ?, ?, ?)");
							$stmt->bind_param("sssss", $guid, $gamename, $icon, $picture, $release);
							$stmt->execute();
							$stmt->close();
						}

						$query = "SELECT gameId FROM games WHERE apiId ='" . $guid . "';";
						$result = $conn->query($query);
							
						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								$gameToAddID = $row["gameId"];
							}
						}

						$stmt = $conn->prepare("INSERT INTO owned_games (gameId, userID) VALUES (?,?)");
						$stmt->bind_param("ss", $gameToAddID, $userid);
						$stmt->execute();
						$stmt->close();

						$query = "INSERT INTO tags(userID, gameId, tag) VALUES ('".$userid."', '".$gameToAddID."', 'Jogando')";
						$result = $conn->query($query);
						echo "<p>Jogo adicionado com sucesso!</p>";
						echo "<p>Jogo foi adicionado com a Tag 'Jogando'. Se desejar, você pode altera-lá mais tarde.</p>";

					}

					if (isset($_GET["gameID"]) && !empty($_GET["gameID"])) {
						$gameToAddID = $_GET["gameID"];
						$query = "INSERT INTO owned_games (gameID, userID) VALUES ('".$gameToAddID."' , '".$userid."')";
						$result = $conn->query($query);
						echo "<Br>Jogo adicionado com sucesso!";
						

						$query = "INSERT INTO tags(userID, gameID, tag) VALUES ('".$userid."', '".$gameToAddID."', 'Playing')";
						$result = $conn->query($query);
						echo "<br>Jogo foi adicionado com a Tag 'Jogando'. Se desejar, você pode altera-lá mais tarde.";
					}

					if (isset($_GET["keyword"]) && !empty($_GET["keyword"])) {
						$gamename = $_GET["keyword"];

						include 'modules/api_game_search.php';

						$gamename = preg_replace('/\s+/', '_', $gamename);

						$gamelist = new SimpleXMLElement(search_game($gamename));
			
						foreach ($gamelist->results->game as $game) {
							$release_date = new DateTime($game->original_release_date);
							$release_date = $release_date->format('Y-m-d');
							echo "<div class='row results'>
								<div class='column-sm'>
								<img src='" . $game->image->icon_url . "'>
								</div>
								<div class='column-lg'>
								<form class='form--search-result' action='search_game.php' method='post'>
								<input type='hidden' name='guid' value='". $game->guid ."'>
								<input type='hidden' name='gamename' value='". $game->name ."'>
								<input type='hidden' name='picture' value='". $game->image->medium_url ."'>
								<input type='hidden' name='icon' value='". $game->image->icon_url ."'>
								<input type='hidden' name='rating' value='". $game->original_game_rating ."'>
								<input type='hidden' name='release' value='". $release_date ."'>
								<label>". $game->name ."</label> <br>
								<label>". $release_date ."</label> <br>
								<select class='select' name='platform'>";
								foreach ($game->platforms->platform as $platform){
									echo "<option value='" . $platform->id ."'>" . $platform->name . "</option>";
								}
							echo "</select>
								<input class='btn' type='submit' value='Adicionar'>
								</form>
								</div>
								</div>";
						}

					$conn->close();
					}
				}

				catch(Exception $e)
				{
					echo $e->getMessage();
				}

		?>
		<p><a href="user_page.php">Voltar para Dashboard</a>
	</div>
</main>

<?php 
	include 'modules/footer.php';
?>