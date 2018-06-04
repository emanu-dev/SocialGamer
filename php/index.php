<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang='pt-br'>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/indexStyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wegamr</title>
</head>
<body>
	<video autoplay muted loop poster="images/bg-poster.JPG" class="bg-video" id="bgVideo">
	   <source src="video/bg-video.mp4" type="video/mp4">
	   <source src="video/bg-video.webm" type="video/webm">
	   <source src="video/bg-video.ogv" type="video/ogg">
	</video>	
	<?php 
		include 'db_conn_var.php';
	?>
	<?php
		if (isset($_GET['status']))
			{
				if (($_GET['status']) == "logout")
				{
					$_SESSION["logged_userID"] = null;
					echo "<p style='color: #ffffff'>Obrigado por usar o WeGaMR!</p>";
				}
				
				if (($_GET['status']) == "notlogged")
				{
					echo "<p style='color: #ffffff'>Faça login para acessar este conteúdo.</p>";
				}
			}

		try {
			$conn = new mysqli($url, $username, $password, $dbname);

			if ($conn->connect_error) {
				throw new Exception($conn->connect_error);
			}else {
				
			}
	    	
	    	$query = "CREATE TABLE IF NOT EXISTS user(userID int AUTO_INCREMENT, username varchar(15), password varchar(8), dob date, image mediumblob, PRIMARY KEY(userID));";
			mysqli_query($conn, $query);
	    	
	    	$query = "CREATE TABLE IF NOT EXISTS console(consoleID int AUTO_INCREMENT, cname varchar(15), manufacturer varchar(15), PRIMARY KEY(consoleID));";		    	
	    	mysqli_query($conn, $query);
	    	
	    	$query = "CREATE TABLE IF NOT EXISTS game(gameID int AUTO_INCREMENT, gname varchar(30), publisher varchar(15), rating varchar(1), consolename int, PRIMARY KEY(gameID), FOREIGN KEY (consolename) REFERENCES console(consoleID));";
			mysqli_query($conn, $query);
	    	
	    	$query = "CREATE TABLE IF NOT EXISTS owned_consoles(consoleID int, userID int, FOREIGN KEY consoleID(consoleID) REFERENCES console(consoleID), FOREIGN KEY (userID) REFERENCES user(userID));";
			mysqli_query($conn, $query);
			
			$query = "CREATE TABLE IF NOT EXISTS owned_games(gameID int, userID int, FOREIGN KEY gameID(gameID) REFERENCES game(gameID), FOREIGN KEY (userID) REFERENCES user(userID));";
			mysqli_query($conn, $query);
			
			$query = "CREATE TABLE IF NOT EXISTS friend(requesterID int, friendID int, accepted boolean, FOREIGN KEY requesterID(requesterID) REFERENCES user(userID), FOREIGN KEY (friendID) REFERENCES user(userID));";	
			mysqli_query($conn, $query);
			
			$query = "CREATE TABLE IF NOT EXISTS recommendation(userID int, gameID int, rec text, FOREIGN KEY userID(userID) REFERENCES user(userID), FOREIGN KEY (gameID) REFERENCES game(gameID));";				
			mysqli_query($conn, $query);
			
			$query = "CREATE TABLE IF NOT EXISTS tags(userID int, gameID int, tag varchar(10), FOREIGN KEY (userID) REFERENCES user(userID), FOREIGN KEY (gameID) REFERENCES game(gameID));";
			mysqli_query($conn, $query);
			
			mysqli_close($conn);	
		}
		catch(Exception $e)
		{
		    echo $e->getMessage();
		}
	?>
	<div class="box-wrapper">
		<div class="signBox flip-in-ver-right">
			<img class="main-logo" src="images/wegamr-logo-purple.svg">
			<p class="logo-title">WeGaMR</p>
			<form action="index.php" method="post">
				<input class="loginInput" type="text" name="username" placeholder="Usuário">
				<input class="loginInput" type="password" name="password" placeholder="Senha">
				<input class="loginBtn" type="submit" value="Log In">
			</form>
			
			<?php
			if (isset($_POST['username']) && !empty($_POST['username']))
			{
				$user = $_POST['username'];
				$pass = $_POST['password'];
				if ($user != null && $pass != null) {
					try {
						$conn = new mysqli($url, $username, $password, $dbname);
			
						if ($conn->connect_error) {
							throw new Exception($conn->connect_error);
						}else {
						}				
			
						$query = "SELECT * FROM user WHERE username='".$user."' and password='".$pass."'";
						$result = $conn->query($query);

						if ($row = $result->num_rows > 0)
							{
								while($row = $result->fetch_assoc()) {
								   $_SESSION["logged_userID"] = $row["userID"];
								   $url="user_page.php";
								   echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
								}
							}else{
								echo "<br>Combinação de senha e usuário incorreta. <br> Se você não possui um conta, clique em Se Inscrever.<br>";
							}
						$conn->close();	
					}
					catch(Exception $e)
					{
					    echo $e->getMessage();
					}		
				} 			
			}
			?>
			<p class="text --regular --small">Não possui uma conta? <a href="signup.php">Se Inscrever</a></p>
		</div>
	</div>
</body>
</html>