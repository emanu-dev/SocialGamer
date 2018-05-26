<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Game Details</title>
</head>
<body>
	<%!
		Connection conn;
		Statement stmt;			
		String url = "jdbc:mysql://localhost:3306/comp5000?allowMultiQueries=true";
		String password = "root";
		String username = "root";
		String query;
		String userid, rating;
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
		<div class="side">
			<h3>Game Details</h3>
			<%

				try {
					String gameid = request.getParameter("gameID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					query = "SELECT game.gameID, game.gname, game.publisher, game.rating, game.consolename, console.consoleID, console.cname FROM game INNER JOIN console ON game.consolename=console.consoleID WHERE game.gameID=\"" + gameid + "\"";
					ResultSet results = stmt.executeQuery(query);

					while (results.next() == true)
					{
						out.println("<h2>"+results.getString("game.gname") + "</h2>");
						out.println("by <i>" + results.getString("game.publisher")+ "</i>");
						out.println("<br>Rating: <br>");
						rating = results.getString("game.rating");
						if (rating.equals("e")){
							out.println("<img src='images/ratingsymbol_e.png' alt='Rated E for Everyone'>");
						}
							
						if (rating.equals("t"))
							{out.println("<img src='images/ratingsymbol_t.png' alt='Rated T for Teens'>");}
						if (rating.equals("m"))
							{out.println("<img src='images/ratingsymbol_m.png' alt='Rated M for Mature'>");}
						if (rating.equals("a"))
							{out.println("<img src='images/ratingsymbol_ao.png' alt='Rated Ao for Adults Only'>");}
					}
					conn.close();
				}
				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}
			%>
		</div>
		
		<div class="side">
			<p><b>Recommendations: </b><br></p>
			<div id="fixedBox">
				<%
					try {
						String gameid = request.getParameter("gameID").toString();
						Class.forName("com.mysql.jdbc.Driver").newInstance();
						conn = DriverManager.getConnection(url, username, password);
						stmt = conn.createStatement();
						query = "SELECT game.gameID, game.gname, recommendation.gameID, recommendation.userID, recommendation.rec FROM recommendation INNER JOIN game ON recommendation.gameID=game.gameID WHERE recommendation.gameID='" + gameid + "';";
						ResultSet results = stmt.executeQuery(query);

						while (results.next() == true)
						{
							out.println("<p><b>Game:</b> " + results.getString("game.gname") + "<br> <b>Recommendation:</b> <i>" + results.getString("recommendation.rec") + "</i></p>");
						}
						conn.close();
					}
					catch (SQLException e) {
						out.println(e);
						e.printStackTrace();
					}
				%>
			</div>
			<p><a href="user_page.jsp">Back to User Page</a>
		</div>
	</div>
</body>
</html>