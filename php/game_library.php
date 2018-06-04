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
	<div class="container slide-in-left">
		<h1 class="main-headline">Biblioteca de Jogos</h1>
		<form methof="link" action="search_game.php">
			<INPUT class="btn" type="submit" value="Adicionar Jogo">
		</form>
		<form method="link" action="edit_tags.php">
			<input class="btn" type="submit" value="Editar Tags">
		</form>		
		<?php
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					if (isset($_GET["gameIdDelete"]) && !empty($_GET["gameIdDelete"])) {
						$deleteId = $_GET["gameIdDelete"];
						$query = "DELETE FROM owned_games WHERE owned_games.userID='".$userid."' AND owned_games.gameId='" . $deleteId ."';";
						$result = $conn->query($query);
					}

					$query = "SELECT games.gameId, games.gname, games.icon, owned_games.gameId, owned_games.userID, tags.gameId, tags.tag, tags.userID FROM owned_games INNER JOIN games ON owned_games.gameId=games.gameId INNER JOIN tags ON games.gameId=tags.gameId WHERE owned_games.userId='".$userid."'";
					$result = $conn->query($query);

					if ($row = $result->num_rows > 0)
					{
						while($row = $result->fetch_assoc()) 
						{
							echo "<div class='row results'>
								<div class='column-sm'>
								<img src='" . $row['icon'] . "'>
								</div>
								<div class='column-lg'>
								<form class='form--search-result' action='game_library.php' method='get'>
								<input type='hidden' name='gameIdDelete' value='". $row['gameId'] ."'>
								<a href='show_game.php?gameId=".$row["gameId"]."'>". $row['gname'] ."</a><br>
								<em>" . $row['tag'] . "</em><br>
								<input class='btn' type='submit' value='Deletar'>
								</form>
								</div>
								</div>";
						}
					}



					$conn->close();
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