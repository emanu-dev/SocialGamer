<?php 
	include 'modules/head.php';
?>
<body>
	<?php 
		include 'db_conn_var.php';
		include_once 'modules/user.handler.php';
		include_once 'modules/games.handler.php';
		include_once 'modules/console.handler.php';			
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
							$consoleid = $_GET["consoleId"];
							$conn = new mysqli($url, $username, $password, $dbname);

							if ($conn->connect_error) {
								throw new Exception($conn->connect_error);
							}else {
								
							}
							$query = "SELECT consoles.consoleId, consoles.cname, consoles.picture FROM consoles WHERE consoles.consoleId=\"".$consoleid."\"";

							$result = $conn->query($query);

							if ($row = $result->num_rows > 0)
							{
									while($row = $result->fetch_assoc()) 
									{
									echo "<h1>".$row["cname"]."</h1></div>";
									echo "<div class='row results'>";
									echo "<div class='column'>";
									echo "<img class='console__img' src='" . $row["picture"] . "'><br>";
									echo "</div>";
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
			<p><a href="user_page.php">Voltar para Dashboard</a>
		</div>
	</main>
	
	<?php 
	include 'modules/footer.php';
	?>