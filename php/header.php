<nav>
	<div class="sidebar">
		<div class="sidebar-header">
			<img class="brand-logo" src="images/wegamr-logo-white.svg" alt="">
		</div><!-- sidebar-header -->
		
			<ul class="nav">
				<li class="nav-item">
					<a href="user_page.php" class="nav-link">
						<i class="fa fa-bar-chart"></i>
						Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a href="search_game.php" class="nav-link">
						<i class="fa fa-files-o"></i>
						Biblioteca
					</a>
				</li>
				<li class="nav-item">
					<a href="search_console.php" class="nav-link">
						<i class="fa fa-calendar"></i>
						Consoles
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fa fa-folder-o"></i>
						Análises
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fa fa-user"></i>
						Amigos
					</a>
				</li>				
			</ul>
		
	</div><!-- sidebar -->
</nav>

<header>
	<div class="header">
		<div class="container">
			<div class="offcanvas">
				<a href="#" class="js-open-sidebar item">
					<i class="fa fa-bars"></i>
				</a>
			</div><!--offcanvas-->

			<div class="date-timer">
				<p>
					<span>
					<?php
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
										// echo $row["username"];
									}
								}

								$conn->close();	
							}
							catch(Exception $e)
							{
								echo $e->getMessage();
							}?>						
					</span>

				</p>
			</div><!-- date-timer -->

			<div class="user">
				<img src="images/user-photo.png" alt="">
				<a href="index.php?status=logout" style="float: right;">Logout</a>
			</div><!-- user -->
		</div><!-- container -->
	</div><!-- header -->
</header>