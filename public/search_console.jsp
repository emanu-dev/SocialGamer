<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Search for Consoles</title>
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
		<h1>Search for Console</h1><Br>
		
		<form action="search_console.jsp" method="get">
		<p>Type a game name to search the database, or <a href="add_console.jsp">add your own</a>:
		<input type="text" name="cname" placeholder="Console Name"></p>
		<input type="submit" value="Search">	
		<%
			String consolename = request.getParameter("cname");
			String consoleToAddID = request.getParameter("consoleID");
			if ((consolename != null))
			{
				try {
					userid = session.getAttribute("logged_userID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					if (consoleToAddID == null){
						query = "SELECT * FROM console WHERE cname LIKE \"%" + consolename + "%\"";
						ResultSet results = stmt.executeQuery(query);
						out.println("<br>Consoles found:");
						while (results.next() == true)
						{
							out.println("<p><form action=\"search_console.jsp\" method=\"get\" >" + results.getString("cname") + " <button name=\"consoleID\" type=\"submit\" value=\"" + results.getString("consoleID") + "\"> Add</button></form></p>");
						}
					}else{
						query = "INSERT INTO owned_consoles (consoleID, userID) VALUES ('" + consoleToAddID + "' , '" + userid + "')";
						stmt.executeUpdate(query);
						out.println("<br>Console sucessfully added!");
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