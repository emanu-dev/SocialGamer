<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Search Users</title>
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
		<form action="search_friend.jsp" method="get">
		<h1>Search Friend</h1><br>
		<p>Type at least part of the username to search for a user:<br></a>
		<input type="text" name="uname" placeholder="UserName"></p>
		<input type="submit" value="Search">	
		<%
			String uname = request.getParameter("uname");
			String friendToAddID = request.getParameter("friendID");
			if ((uname != null))
			{
				try {
					userid = session.getAttribute("logged_userID").toString();
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					stmt = conn.createStatement();
					if (friendToAddID == null){
						query = "SELECT * FROM user WHERE username LIKE \"%" + uname + "%\" and userID!='" + userid + "'";
						ResultSet results = stmt.executeQuery(query);
						out.println("<br>Users found:");
						while (results.next() == true)
						{
							out.println("<p><form action=\"search_friend.jsp\" method=\"get\">" + results.getString("username") + " <button name=\"friendID\" type=\"submit\" value=\"" + results.getString("userID") + "\"> Send Friend Request </button></form></p>");
						}
					}else{
						query = "INSERT INTO friend (requesterID, friendID, accepted) VALUES ('" + userid + "' , '" + friendToAddID + "' , '0')";
						stmt.executeUpdate(query);
						out.println("<br>Friend request sent!");
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