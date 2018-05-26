<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Search for Games</title>
</head>
<body>
	<%!
		Connection conn;
		Statement stmt;			
		String url = "jdbc:mysql://localhost:3306/comp5000?allowMultiQueries=true";
		String password = "root";
		String username = "root";
		String query;
		String userid;
	%>
	<%
			if (session.getAttribute("logged_userID") == null)
			{
	%>
				<jsp:forward page="index.jsp?status=notlogged" />
	<%
			}
	%>	
	
		<div id="header">
		<img src="user.png" width="37px" height="37px"><%
			try {
				userid = session.getAttribute("logged_userID").toString();
				Class.forName("com.mysql.jdbc.Driver").newInstance();
				conn = DriverManager.getConnection(url, username, password);
				stmt = conn.createStatement();
				query = "SELECT * FROM user WHERE userID=\"" + userid + "\"";
				ResultSet results = stmt.executeQuery(query);

				while (results.next() == true)
				{
					out.println(results.getString("username"));
					SimpleDateFormat date_format = new SimpleDateFormat("yyyy-MM-dd");
					Date dob = date_format.parse(results.getString("dob"));
					date_format.applyPattern("MM/dd/yyyy");
					String final_dob = date_format.format(dob);
					%>
					<img src="calendar.png" width="37px" height="37px" >
					<%
					out.println("Birth: " + final_dob);
				}
				conn.close();
			}
			catch (SQLException e) {
				out.println(e);
				e.printStackTrace();
			}%>

		<a href="index.jsp?status=logout" style="float: right;">Logout</a>
	</div>
	<div id="signBox">
		<h1>Search for Game</h1><br>
		<form action="search_game.jsp" method="get">
		<p>Type a game name to search the database, or <a href="add_game.jsp">add your own</a>:</p>
		<input type="text" name="gamename" placeholder="Game"></p>
		<input type="submit" value="Search">	
		<%
			String gamename = request.getParameter("gamename");
			String gameToAddID = request.getParameter("gameID");
			if ((gamename != null))
			{
				try {
					userid = session.getAttribute("logged_userID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					if (gameToAddID == null){
						query = "SELECT * FROM game WHERE gname LIKE \"%" + gamename + "%\"";
						ResultSet results = stmt.executeQuery(query);
						out.println("<br>Games found:");
						while (results.next() == true)
						{
							out.println("<p><form action=\"search_game.jsp\" method=\"get\">" + results.getString("gname") + " <button name=\"gameID\" type=\"submit\" value=\"" + results.getString("gameID") + "\"> Add</button></form></p>");
						}
					}else{
						query = "INSERT INTO owned_games (gameID, userID) VALUES ('" + gameToAddID + "' , '" + userid + "')";
						stmt.executeUpdate(query);
						out.println("<Br>Game sucessfully added!");
						stmt = conn.createStatement();
						query = "INSERT INTO tags(userID, gameID, tag) VALUES ('" + userid + "', '" + gameToAddID + "', 'Playing')";
						stmt.executeUpdate(query);
						out.println("<br>Game was added with the tag Playing. If you wish, you can change its tag on your dashboard.");					
					}
					conn.close();
				}

				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}
			}
		%>
		<p><a href="user_page.jsp">Back to User Page</a>
	</div>
</body>
</html>