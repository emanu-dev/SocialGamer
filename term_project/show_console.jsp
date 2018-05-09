<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Console Details</title>
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
		<div class="side">
			<h3>Console Details</h3>
			<%

				try {
					String consoleid = request.getParameter("consoleID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					query = "SELECT * FROM console WHERE console.consoleID='" + consoleid + "'";
					ResultSet results = stmt.executeQuery(query);

					while (results.next() == true)
					{
						out.println("<h1>"+results.getString("cname") + "</h1><br>");
						out.println("by <i>" + results.getString("manufacturer")+ "</i>");
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
			<p>Games registered for this console: <br></p>
			<div id="fixedBox">
				<%
					try {
						String consoleid = request.getParameter("consoleID").toString();
						Class.forName("com.mysql.jdbc.Driver").newInstance();
						conn = DriverManager.getConnection(url, username, password);
						stmt = conn.createStatement();
						query = "SELECT game.gameID, game.gname, game.publisher, game.rating, game.consolename, console.consoleID, console.cname FROM game INNER JOIN console ON game.consolename=console.consoleID WHERE console.consoleID=\"" + consoleid + "\"";
						ResultSet results = stmt.executeQuery(query);

						while (results.next() == true)
						{
							out.println("<a href=\"show_game.jsp?gameID=" + results.getString("game.gameID") + "\">" + results.getString("game.gname") + "</a><br>");
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