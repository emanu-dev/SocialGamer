<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Log In</title>
</head>
<body>
	<?php
		$url = "localhost:8080/?allowMultiQueries=true";
		$password = "root";
		$username = "root";
		$query = "";
	?>
	
	<%
		if (request.getParameter("status")!=null)
			{
				if (request.getParameter("status").equals("logout"))
				{
					session.setAttribute("logged_userID", null);
					out.println("Thank you for using social gamer!");
				}
				
				if (request.getParameter("status").equals("notlogged"))
				{
					out.println("Please login to access this content.");
				}				
			}

		try {
			Class.forName("com.mysql.jdbc.Driver").newInstance();
			conn = DriverManager.getConnection(url, username, password);
	    	stmt = conn.createStatement();
	    	
	    	query = "CREATE TABLE IF NOT EXISTS user(userID int AUTO_INCREMENT, username varchar(15), password varchar(8), dob date, image mediumblob, PRIMARY KEY(userID));";

	    	query += "CREATE TABLE IF NOT EXISTS console(consoleID int AUTO_INCREMENT, cname varchar(15), manufacturer varchar(15), PRIMARY KEY(consoleID));";		    	
	    	
	    	query += "CREATE TABLE IF NOT EXISTS game(gameID int AUTO_INCREMENT, gname varchar(30), publisher varchar(15), rating varchar(1), consolename int, PRIMARY KEY(gameID), FOREIGN KEY consolename(consolename) REFERENCES console(consoleID));";

	    	query += "CREATE TABLE IF NOT EXISTS owned_consoles(consoleID int, userID int, FOREIGN KEY consoleID(consoleID) REFERENCES console(consoleID), FOREIGN KEY userID(userID) REFERENCES user(userID));";

			query += "CREATE TABLE IF NOT EXISTS owned_games(gameID int, userID int, FOREIGN KEY gameID(gameID) REFERENCES game(gameID), FOREIGN KEY userID(userID) REFERENCES user(userID));";

			query += "CREATE TABLE IF NOT EXISTS friend(requesterID int, friendID int, accepted boolean, FOREIGN KEY requesterID(requesterID) REFERENCES user(userID), FOREIGN KEY friendID(friendID) REFERENCES user(userID));";	

			query += "CREATE TABLE IF NOT EXISTS recommendation(userID int, gameID int, rec text, FOREIGN KEY userID(userID) REFERENCES user(userID), FOREIGN KEY gameID(gameID) REFERENCES game(gameID));";				

			query += "CREATE TABLE IF NOT EXISTS tags(userID int, gameID int, tag varchar(10), FOREIGN KEY userID(userID) REFERENCES user(userID), FOREIGN KEY gameID(gameID) REFERENCES game(gameID));";		
	    	
	    	stmt.executeUpdate(query);
	    	conn.close();		
		}
		catch (SQLException e) {
		   	out.println(e);
		   	e.printStackTrace();
		} 
	%>

	<div id="signBox">
		<p><img src="logo.png"><br>
			<form action="index.php" method="post">
			<input type="text" name="username" placeholder="Username"><br>
			<input type="password" name="password" placeholder="Password">
			<input type="submit" value="Log In"></p>
		</form>

		<?php 
			if (isset($_POST["username"]) && !empty($_POST["password"])) {
				$user = $_POST["username"];
			    $pass = $_POST["password"];
			}else{  
			    $query = "SELECT * FROM user WHERE username='".$user."' and password='".$pass."'";
			}		
		?>

		<%
		
		
		if (user != null && pass != null) {
			try {
				Class.forName("com.mysql.jdbc.Driver").newInstance();
				conn = DriverManager.getConnection(url, username, password);
				stmt = conn.createStatement();
				query = "SELECT * FROM user WHERE username='" + user + "' and password='" + pass + "'";
				ResultSet results = stmt.executeQuery(query);


				if (results.next() == false)
				{
					out.println("<br>Wrong username/password combination. <br> If you do not have an account, click on Sign Up.<br>");
				}else{
					session.setAttribute("logged_userID", results.getString("userID"));
				%>
				<jsp:forward page="user_page.jsp" />
				<%
				}
				conn.close();
			}
			catch (SQLException e) {
				out.println(e);
				e.printStackTrace();
			}		
		}
		%>	
		<br>Don't have an account? <a href="signup.jsp">Sign up</a>
	</div>
</body>
</html>