<?php 
	include 'modules/head.php';
?>

<body>
	<?php 
		include_once 'db_conn_var.php';
		include_once 'modules/user.handler.php';
		include_once 'modules/games.handler.php';
		include_once 'modules/relationship.handler.php';
		include_once 'modules/friend.relation.handler.php'; 
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
					</div>
					<div class="card-block">
					<?php

					try {
						$conn = new mysqli($url, $username, $password, $dbname);
					 
						if ($conn->connect_error) {
							throw new Exception($conn->connect_error);
						}else {
							
						}

						$currentUser = new User();
						$currentUser = $currentUser->getUser($conn, $userid);
						
						echo "<h1>Bem vindo, ".$currentUser->getUsername()."!</h1>";

						$conn->close();	
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
					?>
					</div>
					<div class="card-footer">
					<ul class="nav">
					</ul>
					</div>
				</div>
			</article>
			</div>

			<div class="column-lg">
			<article>
				<div class="card">
					<div class="card-header">
						<h1 class="headline">Jogando agora</h1>
					</div>
					<div class="card-block">
						<?php
							try {
								
								$conn = new mysqli($url, $username, $password, $dbname);

								if ($conn->connect_error) {
									throw new Exception($conn->connect_error);
								}else {
									
								}

								$playingGames = $currentUser->getUserGamesWithTag($conn, 3, 'Jogando');
								?>
								
								<div class='row'>

								<?php
								foreach ($playingGames as $game) {
										$currentGame = new Game();
										$currentGame = $currentGame->getGame($conn, $game['gameId']);
									?>
									<div class='column-sm game-card'>
									<a href='show_game.php?gameId=<?php echo $currentGame->getGameId(); ?>'>
										<img class='game-image' src='<?php echo $currentGame->getPictureSrc(); ?>'>
									<?php echo $currentGame->getname() ?></a>
									</div>
									<?php
								}
								$conn->close();
							}
							catch(Exception $e)
							{
								echo $e->getMessage();
							}
						?>
						</div>
					</div>
					<div class="card-footer">
						<form align="right" method="LINK" action="edit_tags.php">
							<input class="btn" type="submit" value="Editar Tags">
						</form>
					</div>
				</div>
			</article>
			</div> 
		</div> 

		<div class="row">
			<div class="column-sm">
			<article>
				<div class="card contractors">
					<div class="card-header">
						<h1 class="headline">Solicitações de Amizade</h1>
					</div>
					<div class="card-block" style='flex-direction: column'>
							<?php
							try {
								
								$userid = $_SESSION["logged_userID"];

								$conn = new mysqli($url, $username, $password, $dbname);

								if ($conn->connect_error) {
									throw new Exception($conn->connect_error);
								}else {
									
								}
								
								$relation = new Relation($conn, $currentUser);
								$friendRequestList = $relation->getFriendRequests();
								foreach ($friendRequestList as $friendRequest) {
									?>
										<div class='row results'>
											<div class='column-sm'>
												<img class='img-user' src='images/user-placeholder.png'>
											</div>
											<div class='column-lg'>
											<p style='text-align:left'><?php echo $relation->getFriend($friendRequest)->getUsername();?></p>
											</div>
										</div>
										<div class="row">
											<button class='btn add-friend' style='margin: 0 2px' data-user='<?php echo $relation->getFriend($friendRequest)->getUserId();?>' data-action='add'>Adicionar</button>
											<button class='btn add-friend' style='margin: 0 2px' data-user='<?php echo $relation->getFriend($friendRequest)->getUserId();?>' data-action='reject'>Rejeitar</button>										
										</div>
										<hr>
									<?php
								}
								
								$conn->close();
							}
							catch(Exception $e)
							{
								echo $e->getMessage();
							}
						?>
					</div>
					<div class="card-footer">
						<form method="LINK" action="search_friend.php">
							<input class="btn" type="submit" value="Adicionar Amigos">
						</form>						
					</div>
				</div>
			</article>
			</div>

			<div class="column-lg">
			<article>
				<div class="card">
					<div class="card-header">
						<h1 class="headline">Suas Análises</h1>
					</div>
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
					</div>
					<div class="card-footer">
						<form align="right" method="LINK" action="add_recommendation.php">
							<input class="btn" type="submit" value="Nova Análise">
						</form>						
					</div>
				</div>
			</article>	
			</div> 
		</div> 
	</div>
</main>

<?php 
	include 'modules/footer.php';
?>