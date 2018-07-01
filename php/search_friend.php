<?php 
	include 'modules/head.php';
?>
<body>
	<?php 
		include 'db_conn_var.php';
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
	<div class="container slide-in-left">
		<h1 class="main-headline">Buscar Usuário</h1>		
		<form class="form" action="search_friend.php" method="get">
			<p>Digite um nome para buscar no banco:
			<input class="form__text" type="text" name="keyword" placeholder="Nome do Usuário"></p>
			<input class="form__btn --size-sm" type="submit" value="Buscar">
		</form>	
		<?php
			try {
				$conn = new mysqli($url, $username, $password, $dbname);

				if ($conn->connect_error) {
					throw new Exception($conn->connect_error);
				}
				
				$currentUser = new User();
				$currentUser = $currentUser->getUser($conn, $userid);
		
				$relation = new Relation($conn, $currentUser);
				

				if (isset($_GET["keyword"]) && !empty($_GET["keyword"])) {
					$uname = $_GET['keyword'];
					$query = "SELECT * FROM user WHERE username LIKE '%" . $uname . "%' and userID!='" . $userid . "'";
					$result = $conn->query($query);
					
					if ($row = $result->num_rows > 0)
					{
						echo "<br>Usuários Encontrados:";
						while($row = $result->fetch_assoc()) 
						{
							echo "<p><form action=\"search_friend.php\" method=\"get\">" . $row["username"] . "<br><button class='btn' name=\"friendID\" type=\"submit\" value=\"" .  $row["userID"] . "\"> Solicitar Amizade</button></form></p>";
							echo "<hr>";
						}
					}else {
						echo "<br>Nenhum usuário encontrado.";
					}
				}
				
				if (isset($_GET["friendID"]) && !empty($_GET["friendID"])){
					$friendUser = new User();
					$friendUser = $friendUser -> getUser($conn, $_GET['friendID']);
					$relation->addFriendRequest($friendUser);
					echo "<br>Pedido de Amizade enviado!";
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
	</div>
	
	<?php 
	include 'modules/footer.php';
	?>