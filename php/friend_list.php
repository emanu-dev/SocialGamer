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
		<h1 class="main-headline">Lista de Amigos</h1>
		<FORM METHOD="LINK" ACTION="search_friend.php">
			<INPUT class="btn" TYPE="submit" VALUE="Adicionar Amigos">
		</FORM>
		<?php
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					if (isset($_GET["friendIdDelete"]) && !empty($_GET["friendIdDelete"])) {
						$deleteId = $_GET["friendIdDelete"];
						$query = "DELETE FROM friend WHERE userID='".$userid."' AND friendId='" . $deleteId ."';";
						$result = $conn->query($query);
					}

					$query = "SELECT f.friendID, f.requesterID, fu.username as fu_name, ru.username as ru_name, f.accepted FROM friend f INNER JOIN user fu ON fu.userID = f.friendID INNER JOIN user ru ON ru.userID = f.requesterID WHERE (f.requesterID=".$userid." OR f.friendID=".$userid.") AND f.accepted=1;";
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
								<form class='form--search-result' action='friend_list.php' method='get'>
								<input type='hidden' name='friendIdDelete' value='". $row['friendId'] ."'>
								<a href='show_user.php?userId=".$row["friendId"]."'>". $row['cname'] ."</a><br>
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