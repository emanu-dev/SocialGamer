<?php 
	include 'modules/head.php';
?>
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
	
	<main id="main">
		<div class="container slide-in-left">
			<h1>Adicionar Análise</h1>
			<form class="form" action="add_recommendation.php" method="get">
			<p>Jogo:
			<select class="select" name="gameID">
			<?php
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}
					
					$query = "SELECT games.gameId, games.gname, owned_games.gameID, owned_games.userID FROM owned_games INNER JOIN games ON owned_games.gameID=games.gameID WHERE owned_games.userID='".$userid."';";
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
			</select>
			<input class="form__text" type="text" name="rec" placeholder="Sua análise">
			<input class="form__btn" type="submit" value="Confirmar">
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
						echo "<br>Análise adicionada com sucesso";
						$conn->close();
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				}
			?>
			<p><a href="user_page.php">Voltar para Dashboard</a>
		</div>
	</main>
<?php 
	include 'modules/footer.php';
?>