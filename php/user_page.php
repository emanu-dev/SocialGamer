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
						<h2 class="headline">Usuário</h2>
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
								echo "<h1>".$row["username"]."</h1>";
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
						<li class="nav-item">
							<span class="badge warning"></span>
							Jogando
						</li>
						<li class="nav-item">
							<span class="badge info"></span>
							Finalizado
						</li>
						<li class="nav-item">
							<span class="badge primary"></span>
							Backlog
						</li>
					</ul>
					</div><!-- card-footer -->
				</div><!-- card -->
			</article>
			</div><!-- column -->

			<div class="column-lg">
			<article>
				<div class="card">
					<div class="card-header">
						<h2 class="headline">Jogando agora</h2>
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
						<div class="center-block">
							<FORM METHOD="LINK" ACTION="search_game.php">
							<INPUT class="btn" TYPE="submit" VALUE="Add New Game"></FORM>
							<FORM METHOD="LINK" ACTION="edit_tags.php">
							<INPUT class="btn" TYPE="submit" VALUE="Edit Tags"></FORM>
						</div>
					</div><!-- card-block -->
					<div class="card-footer">
					<ul class="nav">
						<li class="nav-item">
							<span class="badge info"></span>
							Jogando
						</li>
						<li class="nav-item">
							<span class="badge primary"></span>
							Finalizado
						</li>
						<li class="nav-item">
							<span class="badge warning"></span>
							Backlog
						</li>
					</ul>
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
						<h2 class="headline">Amigos</h2>
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
						<FORM METHOD="LINK" ACTION="search_friend.php">
						<INPUT class="btn" TYPE="submit" VALUE="Add Friends"><br></FORM>
						<FORM METHOD="LINK" ACTION="friend_requests.php">
						<INPUT class="btn" TYPE="submit" VALUE="Friend Requests"><br></FORM>
					</div>
					<div class="card-footer">
					</div><!-- card-footer -->
				</div><!-- card -->
			</article>
			</div><!-- column -->

			<div class="column-lg">
			<article>
				<div class="card">
					<div class="card-header">
						<h2 class="headline">Análises</h2>
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
						<FORM align="right" METHOD="LINK" ACTION="add_recommendation.php">
						<INPUT class="btn" TYPE="submit" VALUE="Add Recommendation"></FORM>
					</div><!-- card-block -->
					<div class="card-footer">
					</div><!-- card-footer -->
				</div><!-- card -->
			</article>	
			</div> <!-- column -->
		</div> <!-- row -->

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
				<INPUT class="btn" TYPE="submit" VALUE="Add New One"></FORM>
			</div>

	</div><!-- container -->
</main>

<?php 
	include 'modules/footer.php';
?>