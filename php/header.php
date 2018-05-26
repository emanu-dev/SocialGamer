<div id="header">
	<img src="user.png" width="37px" height="37px"><?php
		try {
			
			$conn = new mysqli($url, $username, $password, $dbname);

			if ($conn->connect_error) {
				throw new Exception($conn->connect_error);
			}else {
				
			}

			$query = "SELECT * FROM user WHERE userID='".$userid."'";
			$result = $conn->query($query);

			if ($row = $result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
				{
					echo $row["username"];
					$date = strtotime($row["dob"]);
					$final_dob = date("M/d/y", $date);
					?>
					<img src="calendar.png" width="37px" height="37px" >
					<?php
					echo "Birth: ".$final_dob;
				}
			}

			$conn->close();	
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}?>

	<a href="index.php?status=logout" style="float: right;">Logout</a>
</div>