<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import = "java.util.Date"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Friend Requests</title>
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
		<%
			String friendToAcceptID = request.getParameter("friendID");
			try {
				userid = session.getAttribute("logged_userID").toString();
				Class.forName("com.mysql.jdbc.Driver").newInstance();
				conn = DriverManager.getConnection(url, username, password);
				stmt = conn.createStatement();
				if (friendToAcceptID == null)
				{
					query = "SELECT friend.friendID, friend.requesterID, user.username, user.userID, friend.accepted FROM friend INNER JOIN user ON friend.requesterID=user.userID WHERE friend.friendID=\"" + userid + "\" AND friend.accepted=\'0\';";
					ResultSet results = stmt.executeQuery(query);

					out.println("<br><h1>Your friend requests</h1><br>");
					while (results.next() == true)
					{
						out.println("<p><form action=\"friend_requests.jsp\" method=\"get\">" + results.getString("user.username") + " <button name=\"friendID\" type=\"submit\" value=\"" + results.getString("user.userID") + "\"> Accept </button></form></p>");
					}
				}else{
					query = "UPDATE friend SET accepted = '1' WHERE requesterid='" + userid + "' AND friendid='" + friendToAcceptID + "';";
					query += "UPDATE friend SET accepted = '1' WHERE friendid='" + userid + "' AND requesterid='" + friendToAcceptID + "';";
					stmt.executeUpdate(query);
					out.println("Friend Accepted <br><br> <a href=\"friend_requests.jsp\">Back to Friend Requests </a>");
				}
				conn.close();
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