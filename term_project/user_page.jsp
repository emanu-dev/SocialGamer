<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="userStyle.css">
	
	<title>Social Gamer - User Dashboard</title>
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

	<div id="box">
		<h3> User Details</h3>
			<div id="username">
				<%
				try {
					userid = session.getAttribute("logged_userID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					query = "SELECT * FROM user WHERE userID=\"" + userid + "\"";
					ResultSet results = stmt.executeQuery(query);

					while (results.next() == true)
					{
						out.println("<br><h1>"+results.getString("username")+"</h1>");
					}
					conn.close();
				}
				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}
				%>
			</div>
			
			<div id="consoles">
				Your owned consoles: <br> 
				<%
					try {
						userid = session.getAttribute("logged_userID").toString();
						Class.forName("com.mysql.jdbc.Driver").newInstance();
						conn = DriverManager.getConnection(url, username, password);
						stmt = conn.createStatement();
						query = "SELECT console.consoleID, console.cname, owned_consoles.consoleID, owned_consoles.userID FROM owned_consoles INNER JOIN console ON owned_consoles.consoleID=console.consoleID WHERE owned_consoles.userID='" + userid + "';";
						ResultSet results = stmt.executeQuery(query);

						while (results.next() == true)
						{
							out.println("<a href=\"show_console.jsp?consoleID=" + results.getString("console.consoleID") + "\">" + results.getString("console.cname") + "</a> - ");
						}
						conn.close();
					}
					catch (SQLException e) {
						out.println(e);
						e.printStackTrace();
					}
				%><br>
				<FORM METHOD="LINK" ACTION="search_console.jsp">
				<INPUT TYPE="submit" VALUE="Add New One"></FORM>
			</div>
		
			<div id="library">
				Game Library: <br> 
				<div class="fixedMenu">
					<%
						try {
							userid = session.getAttribute("logged_userID").toString();
							Class.forName("com.mysql.jdbc.Driver").newInstance();
							conn = DriverManager.getConnection(url, username, password);
							stmt = conn.createStatement();
							query = "SELECT game.gameID, game.gname, owned_games.gameID, owned_games.userID, tags.gameID, tags.tag, tags.userID FROM owned_games INNER JOIN game ON owned_games.gameID=game.gameID INNER JOIN tags ON game.gameID=tags.gameID WHERE owned_games.userID='" + userid + "';";
							ResultSet results = stmt.executeQuery(query);

							out.println("<table id=\"gameTable\">");
							out.println( "<tr><th>Name</th><th>Tagged as</th></tr>");
							while (results.next() == true)
							{
								out.println("<tr>");
								out.println("<td><a href=\"show_game.jsp?gameID=" + results.getString("game.gameID") + "\">" + results.getString("game.gname") + "</a></td>");
								out.println("<td>" + results.getString("tags.tag") + "</td>");		    	
								out.println("</tr>");
							}
							out.println("</table>");
							
							conn.close();
						}
						catch (SQLException e) {
							out.println(e);
							e.printStackTrace();
						}
					%>
				</div><br>
				<FORM METHOD="LINK" ACTION="search_game.jsp">
				<INPUT TYPE="submit" VALUE="Add New Game"></FORM>
				<FORM METHOD="LINK" ACTION="edit_tags.jsp">
				<INPUT TYPE="submit" VALUE="Edit Tags"></FORM>
			</div>
			
			<div id="friends">
				Friends: <br> 
				<div class="fixedMenu">
					<%
						try {
							userid = session.getAttribute("logged_userID").toString();
							Class.forName("com.mysql.jdbc.Driver").newInstance();
							conn = DriverManager.getConnection(url, username, password);
							stmt = conn.createStatement();
							query = "SELECT f.friendID, f.requesterID, fu.username as fu_name, ru.username as ru_name, f.accepted FROM friend f INNER JOIN user fu ON fu.userID = f.friendID INNER JOIN user ru ON ru.userID = f.requesterID WHERE (f.requesterID=\"" + userid + "\"" + " OR f.friendID=\"" + userid + "\") AND f.accepted=\'1\';";
							ResultSet results = stmt.executeQuery(query);

							while (results.next() == true)
							{
								if (Integer.parseInt(results.getString("f.friendID")) == Integer.parseInt(userid))
								{
									out.println("<a href=\"show_user.jsp?friendID=" + results.getString("f.requesterID") + "\">" + results.getString("ru_name") + "</a><br>");
								}else{
									out.println("<a href=\"show_user.jsp?friendID=" + results.getString("f.friendID") + "\">" + results.getString("fu_name") + "</a><br>");
								}
							}
							conn.close();
						}
						catch (SQLException e) {
							out.println(e);
							e.printStackTrace();
						}
					%>
				</div><br>
				<FORM METHOD="LINK" ACTION="search_friend.jsp">
				<INPUT TYPE="submit" VALUE="Add Friends"></FORM>
				<FORM METHOD="LINK" ACTION="friend_requests.jsp">
				<INPUT TYPE="submit" VALUE="Friend Requests"></FORM>
			</div>
		
		<div style="clear:both"></div>
		<div id="footer">
			Recommendations: <br> 
			<div id="recommendation">
				<%
					try {
						userid = session.getAttribute("logged_userID").toString();
						Class.forName("com.mysql.jdbc.Driver").newInstance();
						conn = DriverManager.getConnection(url, username, password);
						stmt = conn.createStatement();
						query = "SELECT game.gameID, game.gname, recommendation.gameID, recommendation.userID, recommendation.rec FROM recommendation INNER JOIN game ON recommendation.gameID=game.gameID WHERE recommendation.userID='" + userid + "';";
						ResultSet results = stmt.executeQuery(query);

						while (results.next() == true)
						{
							out.println("<p><b>Game</b>: " + results.getString("game.gname") + "<br> Your Recommendation: <i>" + results.getString("recommendation.rec") + "</i></p>");
						}
						conn.close();
					}
					catch (SQLException e) {
						out.println(e);
						e.printStackTrace();
					}
				%>
			</div><br>
			<FORM align="right" METHOD="LINK" ACTION="add_recommendation.jsp">
			<INPUT TYPE="submit" VALUE="Add Recommendation"></FORM>
		</div>
	</div>
</body>
</html>