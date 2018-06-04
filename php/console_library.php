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
		<h1 class="main-headline">Biblioteca de Consoles</h1>
		<FORM METHOD="LINK" ACTION="search_Console.php">
			<INPUT class="btn" TYPE="submit" VALUE="Adicionar Console">
		</FORM>
		<?php
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					if (isset($_GET["consoleIdDelete"]) && !empty($_GET["consoleIdDelete"])) {
						$deleteId = $_GET["consoleIdDelete"];
						$query = "DELETE FROM owned_consoles WHERE owned_consoles.userID='".$userid."' AND owned_consoles.consoleId='" . $deleteId ."';";
						$result = $conn->query($query);
					}

					$query = "SELECT consoles.consoleId, consoles.cname, consoles.icon, owned_consoles.consoleId, owned_consoles.userID FROM owned_consoles INNER JOIN consoles ON owned_consoles.consoleId=consoles.consoleId WHERE owned_consoles.userId='".$userid."'";
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
								<form class='form--search-result' action='console_library.php' method='get'>
								<input type='hidden' name='consoleIdDelete' value='". $row['consoleId'] ."'>
								<a href='show_console.php?consoleId=".$row["consoleId"]."'>". $row['cname'] ."</a><br>
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