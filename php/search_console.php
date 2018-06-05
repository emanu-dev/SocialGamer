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
		<h1 class="main-headline">Buscar Console</h1>		
		<form class="form" action="search_console.php" method="get">
			<p>Digite um nome para buscar no banco</a>:
			<input class="form__text" type="text" name="keyword" placeholder="Nome do Console"></p>
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
						$consolename = $_POST["consolename"];
						$icon = $_POST["icon"];
						$picture = $_POST["picture"];
						$consoleToAddID = "";
						
						$query = "SELECT consoleID FROM consoles WHERE apiId ='" . $guid . "';";
						$result = $conn->query($query);


						if ($result->num_rows == 0)
						{
							$stmt = $conn->prepare("INSERT INTO consoles (apiId, cname, icon, picture) VALUES (?, ?, ?, ?)");
							$stmt->bind_param("ssss", $guid, $consolename, $icon, $picture);
							$stmt->execute();
							$stmt->close();
						}

						$query = "SELECT consoleID FROM consoles WHERE apiId ='" . $guid . "';";
						$result = $conn->query($query);
							
						if ($row = $result->num_rows > 0)
						{
							while($row = $result->fetch_assoc()) 
							{
								$consoleToAddID = $row["consoleID"];
							}
						}

						$stmt = $conn->prepare("INSERT INTO owned_consoles (consoleID, userID) VALUES (?,?)");
						$stmt->bind_param("ss", $consoleToAddID, $userid);
						$stmt->execute();
						$stmt->close();

						echo "<p>Console adicionado com sucesso</p>";
					}

					if (isset($_GET["keyword"]) && !empty($_GET["keyword"])) {
						$consolename = $_GET["keyword"];

						include 'modules/api_console_search.php';

						$consolename = preg_replace('/\s+/', '_', $consolename);

						$consolelist = new SimpleXMLElement(search_console($consolename));
			
						foreach ($consolelist->results->platform as $platform) {
							echo "<div class='row results'>
								<div class='column-sm'>
								<img src='" . $platform->image->icon_url . "'>
								</div>
								<div class='column-lg'>
								<form class='form--search-result' action='search_console.php' method='post'>
								<input type='hidden' name='guid' value='". $platform->guid ."'>
								<input type='hidden' name='consolename' value='". $platform->name ."'>
								<input type='hidden' name='picture' value='". $platform->image->medium_url ."'>
								<input type='hidden' name='icon' value='". $platform->image->icon_url ."'>
								<label>". $platform->name ."</label> <br>
								<input class='btn' type='submit' value='Adicionar'>
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