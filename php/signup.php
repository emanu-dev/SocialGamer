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
	<script src="style/bundle.js"></script>
</head>
<body>
	<?php 
		include 'db_conn_var.php';
	?>

	<div class="signBox">
		<h1>Criar uma nova conta</h1><br><br>
		<form action="signup.php" method="post">
		<input class="loginInput" type="text" name="username" placeholder="Usuário">
		<input class="loginInput" type="password" name="password" placeholder="Senha">
		<p>Data de Nascimento:<br>
		<input class="loginInput" name="dob" type="date">
		<br><br>
		<input class="loginBtn" type="submit" value="Confirmar">
		</form>
	
		<?php

			if (isset($_POST['username']) && !empty($_POST['username'])) {
			$user = $_POST["username"];
			$pass = $_POST["password"];

			$dob = date("Y-m-d", strtotime($_POST['dob']));			

				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					if($stmt = $conn->prepare("INSERT INTO user(username, password, dob) VALUES (?, ?, ?)")) {
					    $stmt->bind_param('sss', $user, $pass, $dob);
					    $stmt->execute();
					    echo "Usuário \"".$user."\" criado com sucesso<br>";
					} else {
					    $error = $conn->errno . ' ' . $conn->error;
					    echo $error;
					}

					mysqli_close($conn);
				}
					catch(Exception $e)
					{
					    echo $e->getMessage();
					}
			}
		?>
			<br><a href="index.php">Login</a>
	</div>
</body>
</html>