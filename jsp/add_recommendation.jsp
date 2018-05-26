<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Add Recommendation</title>
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
		<h1>Add Recommendation</h1><br><br>
		<form action="add_recommendation.jsp" method="get">
		<p>Game to reccomend:
		<select name="gameID">
		<%
			try {
				String userid = session.getAttribute("logged_userID").toString();
				Class.forName("com.mysql.jdbc.Driver").newInstance();
				conn = DriverManager.getConnection(url, username, password);
				stmt = conn.createStatement();
				query = "SELECT game.gameID, game.gname, owned_games.gameID, owned_games.userID FROM owned_games INNER JOIN game ON owned_games.gameID=game.gameID WHERE owned_games.userID='" + userid + "';";
				ResultSet results = stmt.executeQuery(query);

				while (results.next() == true)
				{
					String gvalue = results.getString("game.gameID");
					String gname = results.getString("game.gname");
					out.println("<option value='" + gvalue + "'>" + gname + "</option>");
				}
				conn.close();
			}
			catch (SQLException e) {
				out.println(e);
				e.printStackTrace();
			}
		%>
		<input type="text" name="rec" placeholder="Write Recommendation">
		<input type="submit" value="Confirm">
		</form>

		<%
			String gameid = request.getParameter("gameID");
			String rec = request.getParameter("rec");

			if (gameid != null) {
				try {
					String userid = session.getAttribute("logged_userID").toString();		
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					query = "INSERT INTO recommendation(userID, gameID, rec) VALUES ('" + userid + "','" + gameid + "','" + rec + "')";
					stmt.executeUpdate(query);
					out.println("<br>Recommendation was added with success");
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