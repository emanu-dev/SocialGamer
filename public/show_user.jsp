<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="personStyle.css">
	<title>Social Gamer - User Page</title>
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
		<div id="details">
			<h3> Gamer Details</h3><Br>
			<%
				try {
					userid = request.getParameter("friendID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					query = "SELECT * FROM user WHERE userID=\"" + userid + "\"";
					ResultSet results = stmt.executeQuery(query);

					while (results.next() == true)
					{
						out.println("<h1>" + results.getString("username") +"</h1><br>");
						SimpleDateFormat date_format = new SimpleDateFormat("yyyy-MM-dd");
						Date dob = date_format.parse(results.getString("dob"));
						date_format.applyPattern("MM/dd/yyyy");
						String final_dob = date_format.format(dob);
						out.println("Birth: " + final_dob);
					}
				}
				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}
			%>
		</div>

		<div id="library">
			<b>Game Library: </b><br>
			<div class="fixedBox">
				<%
					try {
						userid = request.getParameter("friendID").toString();
						Class.forName("com.mysql.jdbc.Driver").newInstance();
						conn = DriverManager.getConnection(url, username, password);
						stmt = conn.createStatement();
						query = "SELECT game.gameID, game.gname, owned_games.gameID, owned_games.userID, tags.gameID, tags.tag, tags.userID FROM owned_games INNER JOIN game ON owned_games.gameID=game.gameID INNER JOIN tags ON game.gameID=tags.gameID WHERE owned_games.userID='" + userid + "';";
						ResultSet results = stmt.executeQuery(query);

						out.println("<table id=\"gameTable\">");
						out.println( "<tr><th>Name</th><th>Tagged as</th>");
						while (results.next() == true)
						{
							out.println("<tr>");
							out.println("<td><a href=\"show_game.jsp?gameID=" + results.getString("game.gameID") + "\">" + results.getString("game.gname") + "</a></td>");
							out.println("<td>" + results.getString("tags.tag") + "</td>");		    	
							out.println("</tr>");
						}
						out.println("</table>");
					}
					catch (SQLException e) {
						out.println(e);
						e.printStackTrace();
					}
				%>
			</div>
		</div>
	<div style="clear:both"></div>
	
	<div class="content">
		<br><b>Owned consoles: </b><br>
		<div class="fixedBox">
			<%
				try {
					userid = request.getParameter("friendID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					query = "SELECT console.consoleID, console.cname, owned_consoles.consoleID, owned_consoles.userID FROM owned_consoles INNER JOIN console ON owned_consoles.consoleID=console.consoleID WHERE owned_consoles.userID='" + userid + "';";
					ResultSet results = stmt.executeQuery(query);

					while (results.next() == true)
					{
						out.println("<a href=\"show_console.jsp?consoleID=" + results.getString("console.consoleID") + "\">" + results.getString("console.cname") + "</a> -");
					}
					conn.close();
				}
				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}
			%>
		</div>
	</div>
	
	<div class="content">
		<br><b>Recommendations: </b><br>
		<div class="fixedBox">
			<%
				try {
					userid = request.getParameter("friendID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					query = "SELECT game.gameID, game.gname, recommendation.gameID, recommendation.userID, recommendation.rec FROM recommendation INNER JOIN game ON recommendation.gameID=game.gameID WHERE recommendation.userID='" + userid + "';";
					ResultSet results = stmt.executeQuery(query);

					while (results.next() == true)
					{
						out.println("<p>Game: " + results.getString("game.gname") + "<br> Recommendation: <i>" + results.getString("recommendation.rec") + "</i></p>");
					}
					conn.close();
				}
				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}
			%>
		</div>
	</div>
	<a href="user_page.jsp">Back to User Page</a>
	
	</div>
</body>
</html>