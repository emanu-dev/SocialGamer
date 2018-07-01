<?php
// Start the session
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang='pt-br'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wegamr</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
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