<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Add Game</title>
</head>
<body>

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
		
		<div id="signBox">
		<h1>Add New Game</h1><br>
		<%
			String gamename = request.getParameter("gamename");
			String publisher = request.getParameter("publisher");
			String rating = request.getParameter("rating");
			String console = request.getParameter("consoleid");

			if (gamename != null)
			{
				userid = session.getAttribute("logged_userID").toString();
				try {
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					query = "INSERT INTO game (gname, publisher, rating, consolename) VALUES ('" + gamename + "', '" + publisher + "' , '" + rating + "' , '" + console + "')";
					stmt.executeUpdate(query);
					out.println("<br><br>Game added to the database. Now you can go back to the search page and add it to your library.");
					conn.close();
				}
				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}
			}else{
				Class.forName("com.mysql.jdbc.Driver").newInstance();
				conn = DriverManager.getConnection(url, username, password);
				stmt = conn.createStatement();
				query = "SELECT consoleID, cname FROM console";
				ResultSet results = stmt.executeQuery(query);

				out.println("<br><form action=\"add_game.jsp\" method=\"get\">");
				out.println("<input type=\"text\" name=\"gamename\" placeholder=\"Game Name\"> ");
				out.println("<input type=\"text\" name=\"publisher\" placeholder=\"Publisher\">");
				out.println("<p>Rating:  <select name=\"rating\"><option value=\"e\">E for Everyone</option><option value=\"t\">Teen +13</option><option value=\"m\">Mature +17</option><option value=\"a\">Adults Only +21</option></select></p>");
				out.println("<p>Console: <select name=\"consoleid\">");
				while (results.next() == true)
				{
					String name = results.getString("cname");
					String value = results.getString("consoleID");
					out.println("<option value=\"" + value + "\">" + name + "</option>");
				}
				out.println("</select></p>");
				out.println("<input type=\"submit\" value=\"Submit\">");
		}
		%>
		<p><a href="search_game.jsp">Back to Search Game Page</a>
		<p><a href="user_page.jsp">Back to User Page</a>
	</div>
</body>
</html>