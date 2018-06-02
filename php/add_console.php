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
	<div class="container">
		<h1 class="main-headline">Adicionar Console</h1>	
		<?php

			$consolename = null;
			$manufacturer = null;
			
			if (isset($_GET["cname"])) {
				$consolename = $_GET["cname"];
				$manufacturer = $_GET["manufacturer"];
			}
			

			if ($consolename != null)
			{
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}
					
					$query = "INSERT INTO console (cname, manufacturer) VALUES ('".$consolename."', '".$manufacturer."')";
					$result = $conn->query($query);
					echo "<br>Console added to the database. Now you can go back to the search page and add it to your library.";
					
					$conn->close();	
				}
				catch(Exception $e)
				{
					echo $e->getMessage();
				}
			}else{
				echo "<form class=\"form\" action=\"add_console.php\" method=\"get\">";
				echo "<input class=\"form__text\" type=\"text\" name=\"cname\" placeholder=\"Console Name\">";
				echo "<input class=\"form__text\" type=\"text\" name=\"manufacturer\" placeholder=\"Manufacturer\">";
				echo "</select></p>";
				echo "<input class=\"form__btn\"type=\"submit\" value=\"Submit\">";
		}
		?>
		<p><a href="search_console.php">Back to Search Console Page</a>
		<p><a href="user_page.php">Back to User Page</a>
		</div>
	</main>
</body>
</html>