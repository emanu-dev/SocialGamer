<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<%@ page language="java" %>
<%@ page import = "java.sql.*"%>
<%@ page import="java.text.SimpleDateFormat" %>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
	<title>Social Gamer - Sign up for an Account</title>
</head>
<body>
	<%!
		Connection conn;
		Statement stmt;			
		String url = "jdbc:mysql://localhost:3306/comp5000?allowMultiQueries=true";
		String password = "root";
		String username = "root";
		String query;
		
	%>

	<div id="signBox">
		<h1>Create a New Account</h1><br><br>
		<form action="signup.jsp" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<p>Date of Birth:
		<select name="dob_month">
			<%
				for (int i = 1; i<=12; i++)
				{
					out.println("<option value='" + i + "'>" + i + "</option>");
				}
			%>
		</select>
		<select name="dob_day">
			<%
				for (int i = 1; i<=31; i++)
				{
					out.println("<option value='" + i + "'>" + i + "</option>");
				}
			%>
		</select>
		<select name="dob_year">
			<%
				for (int i = 1900; i<=2015; i++)
				{
					out.println("<option value='" + i + "'>" + i + "</option>");
				}
			%>
		</select>		<br><br>
		<input type="submit" value="Confirm">
		</form>
	
		<%
			String user = request.getParameter("username");
			String pass = request.getParameter("password");

			String dob_year = request.getParameter("dob_year");
			String dob_month = request.getParameter("dob_month");	
			String dob_day = request.getParameter("dob_day");	

			if (user != null) {	
				java.sql.Date dob = java.sql.Date.valueOf(dob_year +"-"+ dob_month +"-"+ dob_day);

				try {
					Class.forName("com.mysql.jdbc.Driver").newInstance();
					conn = DriverManager.getConnection(url, username, password);
					
					PreparedStatement ps = conn.prepareStatement("INSERT INTO user(username, password, dob) VALUES (?, ?, ?)");
				 
					ps.setString(1, user);
					ps.setString(2, pass);
					ps.setDate(3, dob);

					ps.executeUpdate();
					out.println("Data for user " + user + " was inserted with success<br>");
					conn.close();
				}
				catch (SQLException e) {
					out.println(e);
					e.printStackTrace();
				}
			}
		%>
			<br><a href="index.jsp">Back to Log In Page</a>
	</div>
</body>
</html>