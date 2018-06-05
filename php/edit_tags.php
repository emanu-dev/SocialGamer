<?php 
	include 'modules/head.php';
?>
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
<main id="main">
	<div class="container slide-in-left">
		<h1 class="main-headline">Editar Tags</h1>
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
						
						$query = "UPDATE tags SET tag='".$tag."' WHERE userID='".$userid."' AND gameId='".$gameid."'";
						$result = $conn->query($query);
						echo "<br><b>Tag atualizada!</b>";	
					}else{	
						$query = "SELECT games.gameId, games.gname, owned_games.gameId, owned_games.userID FROM owned_games INNER JOIN games ON owned_games.gameId=games.gameId WHERE owned_games.userID='".$userid."';";
						$result = $conn->query($query);

						echo "<form class='form' action='edit_tags.php' method='get'>";
						echo "<input type='hidden' name='edit' value='1'>";
						echo "<p>Escolha o jogo: ";
						echo "<select class='select' name='gameID'>";

						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								$gvalue = $row["gameId"];
								$gname = $row["gname"];
								echo "<option value='".$gvalue."'>".$gname."</option>";
							}
						}
						echo "</select>";
						echo "<p>Tag para alterar: ";
						echo "<select class='select' name='tag'>";
						echo "<option value='Jogando'>Jogando</option>";
						echo "<option value='Finalizado'>Finalizado</option>";
						echo "<option value='Parado'>Parado</option>";
						echo "</select><br><br><Br>";
						echo "<input class='form__btn' type='submit' value='Salvar'>";
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