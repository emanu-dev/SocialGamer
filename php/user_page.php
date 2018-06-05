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
		<h1 class="main-headline">Dashboard</h1>
		<div class="row">
			<div class="column-sm">
			<article>
				<div class="card">
					<div class="card-header">
						<h1 class="headline">Resumo do Usuário</h1>
					</div><!--card header-->
					<div class="card-block">
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
								echo "<h1>Bem vindo, ".$row["username"]."!</h1>";
							}
						}
						$conn->close();	
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
					?>
					</div><!-- card-block -->
					<div class="card-footer">
					<ul class="nav">
					</ul>
					</div><!-- card-footer -->
				</div><!-- card -->
			</article>
			</div><!-- column -->

			<div class="column-lg">
			<article>
				<div class="card">
					<div class="card-header">
						<h1 class="headline">Jogando agora</h1>
					</div><!--card header-->
					<div class="card-block">
						<?php
							try {
								
								$userid = $_SESSION["logged_userID"];

								$conn = new mysqli($url, $username, $password, $dbname);

								if ($conn->connect_error) {
									throw new Exception($conn->connect_error);
								}else {
									
								}

								$query = "SELECT games.gameId, games.gname, games.picture, owned_games.gameId, owned_games.userID, tags.gameId, tags.tag, tags.userID FROM owned_games INNER JOIN games ON owned_games.gameId=games.gameId INNER JOIN tags ON games.gameId=tags.gameId WHERE owned_games.userId='".$userid."' AND tags.tag = 'Jogando' LIMIT 3";

								$result = $conn->query($query);

								echo "<div class='row'>";
							if ($row = $result->num_rows > 0)
							{
								while($row = $result->fetch_assoc()) 
								{
									echo "<div class='column-sm game-card'>";
									echo "<a href='show_game.php?gameId=".$row["gameId"]."'><img class='game-image' src='" . $row["picture"] . "'>";
									echo $row["gname"]."</a>";
									echo "</div>";
								}
							}
								echo "</div>";
								
								$conn->close();
							}
							catch(Exception $e)
							{
								echo $e->getMessage();
							}
						?>
					</div><!-- card-block -->
					<div class="card-footer">
						<form align="right" method="LINK" action="edit_tags.php">
							<input class="btn" type="submit" value="Editar Tags">
						</form>
					</div><!-- card-footer -->
				</div><!-- card -->
			</article>
			</div> <!-- column -->
		</div> <!-- row -->

		<div class="row">
			<div class="column-sm">
			<article>
				<div class="card contractors">
					<div class="card-header">
						<h1 class="headline">Solicitações de Amizade</h1>
					</div><!--card header-->
					<div class="card-block">
							<?php
							try {
								
								$userid = $_SESSION["logged_userID"];

								$conn = new mysqli($url, $username, $password, $dbname);

								if ($conn->connect_error) {
									throw new Exception($conn->connect_error);
								}else {
									
								}

								$query = "SELECT f.friendID, f.requesterID, fu.username as fu_name, ru.username as ru_name, f.accepted FROM friend f INNER JOIN user fu ON fu.userID = f.friendID INNER JOIN user ru ON ru.userID = f.requesterID WHERE (f.requesterID=".$userid." OR f.friendID=".$userid.") AND f.accepted=0;";
								
								$result = $conn->query($query);


								if ($row = $result->num_rows > 0)
								{
									while($row = $result->fetch_assoc()) 
									{
										if (intval($row["friendID"]) == intval($userid))
										{
											echo "<p class='add-friend' data-user='".$row["requesterID"]."'>".$row["ru_name"]."</p>";
										}else{
											echo "<p class='add-friend' data-user='".$row["friendID"]."'>".$row["fu_name"]."</p>";
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
						<p id='txtHint'></p>
					</div>
					<div class="card-footer">
						<form method="LINK" action="search_friend.php">
							<input class="btn" type="submit" value="Adicionar Amigos">
						</form>						
					</div><!-- card-footer -->
				</div><!-- card -->
			</article>
			</div><!-- column -->

			<div class="column-lg">
			<article>
				<div class="card">
					<div class="card-header">
						<h1 class="headline">Suas Análises</h1>
					</div><!--card header-->
					<div class="card-block">
						<?php
							try {

								$userid = $_SESSION["logged_userID"];

								$conn = new mysqli($url, $username, $password, $dbname);

								if ($conn->connect_error) {
									throw new Exception($conn->connect_error);
								}else {
									
								}
								
								$query = "SELECT games.gameId, games.gname, games.icon, recommendation.gameId, recommendation.userID, recommendation.rec FROM recommendation INNER JOIN games ON recommendation.gameId=games.gameId WHERE recommendation.userID='".$userid."';";
								
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
										<a href='show_game.php?gameId=".$row["gameId"]."'>". $row['gname'] ."</a><br>
										<em>" . $row['rec'] . "</em><br>
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
					</div><!-- card-block -->
					<div class="card-footer">
						<form align="right" method="LINK" action="add_recommendation.php">
							<input class="btn" type="submit" value="Nova Análise">
						</form>						
					</div><!-- card-footer -->
				</div><!-- card -->
			</article>	
			</div> <!-- column -->
		</div> <!-- row -->
	</div><!-- container -->
</main>

<?php 
	include 'modules/footer.php';
?>