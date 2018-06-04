<nav>
	<div class="sidebar">
		<div class="sidebar-header">
			<img class="brand-logo" src="images/wegamr-logo-white.svg" alt="">
		</div><!-- sidebar-header -->
		
			<ul class="nav">
				<li class="nav-item">
					<a href="user_page.php" class="nav-link">
						<?php echo file_get_contents("images/icon/monitor.svg"); ?>
						Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a href="game_library.php" class="nav-link">
						<?php echo file_get_contents("images/icon/cartridge.svg"); ?>
						Biblioteca
					</a>
				</li>
				<li class="nav-item">
					<a href="console_library.php" class="nav-link">
						<?php echo file_get_contents("images/icon/joystick.svg"); ?>
						Consoles
					</a>
				</li>
				<li class="nav-item">
					<a href="friend_list.php" class="nav-link">
						<?php echo file_get_contents("images/icon/user.svg"); ?>
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
				<?php echo file_get_contents("images/icon/menu.svg"); ?>
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
				<!-- <img src="images/user-photo.png" alt=""> -->
				<a href="index.php?status=logout" style="float: right;">
					<?php echo file_get_contents("images/icon/logout.svg"); ?>
				</a>
			</div><!-- user -->
		</div><!-- container -->
	</div><!-- header -->
</header>