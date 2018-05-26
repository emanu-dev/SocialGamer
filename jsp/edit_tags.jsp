<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Edit Tags</title>
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
		String edited;
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
		<h1>Edit Tags</h1><br>
		<p>Your games: <br>
		<%
				edited = request.getParameter("edit");
				try {
					String userid = session.getAttribute("logged_userID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					if (edited != null)
					{
						String gameid = request.getParameter("gameID");
						String tag = request.getParameter("tag");
						stmt = conn.createStatement();
						query = "UPDATE tags SET tag='" + tag + "' WHERE userID='" + userid + "' AND gameID='" + gameid + "'";
						stmt.executeUpdate(query);
						out.println("<br><b>Tag updated!</b>");	
					}else{	
						stmt = conn.createStatement();		    
						query = "SELECT game.gameID, game.gname, owned_games.gameID, owned_games.userID FROM owned_games INNER JOIN game ON owned_games.gameID=game.gameID WHERE owned_games.userID='" + userid + "';";
						ResultSet results = stmt.executeQuery(query);

						out.println("<form action='edit_tags.jsp' method='get'>");
						out.println("<input type='hidden' name='edit' value='1'>");
						out.println("<p>Your Games:");
						out.println("<select name='gameID'>");

						while (results.next() == true)
						{
							String gvalue = results.getString("game.gameID");
							String gname = results.getString("game.gname");
							out.println("<option value='" + gvalue + "'>" + gname + "</option>");
						}
						out.println("</select>");
						out.println("<p>Tag to apply:");
						out.println("<select name='tag'>");
						out.println("<option value='Playing'>Playing</option>");
						out.println("<option value='Finished'>Finished</option>");
						out.println("<option value='OnBacklog'>OnBacklog</option>");
						out.println("</select><br><br><Br>");
						out.println("<input type='submit' value='Save'>");
					}
				}
				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}			
		%>

		<p><a href="user_page.jsp">Back to User Page</a>
	</div>
</body>
</html>