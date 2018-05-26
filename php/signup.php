<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang='pt-br'>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Sign up for an Account</title>
</head>
<body>
	<?php 
		include 'db_conn_var.php';
	?>

	<div id="signBox">
		<h1>Create a New Account</h1><br><br>
		<form action="signup.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<p>Date of Birth:
		<input name="dob" type="date">
		<br><br>
		<input type="submit" value="Confirm">
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
					    echo "Data for user ".$user." was inserted with success<br>";
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
			<br><a href="index.php">Back to Log In Page</a>
	</div>
</body>
</html>