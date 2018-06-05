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
			<h1>Detalhes do jogo</h1>
			<div class="row results">
					<?php
						try {
							$gameid = $_GET["gameId"];
							$conn = new mysqli($url, $username, $password, $dbname);

							if ($conn->connect_error) {
								throw new Exception($conn->connect_error);
							}else {
								
							}
							$query = "SELECT games.gameId, games.gname, games.rating, games.picture, games.release_date FROM games WHERE games.gameId=\"".$gameid."\"";

							$result = $conn->query($query);

							if ($row = $result->num_rows > 0)
							{
									while($row = $result->fetch_assoc()) 
									{
									echo "<h1>".$row["gname"]."</h1></div>";
									echo "<div class='row results'>";
									echo "<div class='column'>";
									echo "<img class='game__img' src='" . $row["picture"] . "'><br>";
									echo "</div>";
									echo "<div class='column'>";
									echo "<p>Data de Lançamento: " . $row["release_date"] . "</p>";
								}
							}
							$conn->close();
						}
						catch(Exception $e)
						{
							echo $e->getMessage();
						}
					?>

				<hr>
				<h1>Análises: </h1>
				<div class="row results">
					<div class="column-lg">
						<ul>
						<?php
							try {
								$gameid = $_GET["gameId"];
								$conn = new mysqli($url, $username, $password, $dbname);

								if ($conn->connect_error) {
									throw new Exception($conn->connect_error);
								}else {
									
								}
								$query = "SELECT games.gameId, games.gname, recommendation.gameId, recommendation.userID, recommendation.rec FROM recommendation INNER JOIN games ON recommendation.gameId=games.gameId WHERE recommendation.gameId='".$gameid."';";
									
								$result = $conn->query($query);

								if ($row = $result->num_rows > 0)
								{
									while($row = $result->fetch_assoc()) 
									{
										echo "<li>".$row["rec"]."</li>";
									}
								}
								$conn->close();
							}
							catch(Exception $e)
							{
								echo $e->getMessage();
							}
						?>
						</ul>
					</div>
				</div>
			<p><a href="user_page.php">Voltar para Dashboard</a>
		</div>
	</main>
	
	<?php 
	include 'modules/footer.php';
	?>