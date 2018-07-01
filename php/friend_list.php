<?php 
	include 'modules/head.php';
?>
<body>
	<?php 
		include 'db_conn_var.php';
		include_once 'modules/user.handler.php';
		include_once 'modules/games.handler.php';
		include_once 'modules/relationship.handler.php';
		include_once 'modules/friend.relation.handler.php'; 		
		$userid;
	?>

	<?php
		if (isset($_SESSION["logged_userID"])) {
			$userid = $_SESSION["logged_userID"];
		}else {
			$url="index.php?status=notlogged";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
		}
	?>	
	
	<?php 
		include 'header.php';
	?>

<main id="main">
	<div class="container slide-in-left">
		<h1 class="main-headline">Lista de Amigos</h1>
			<form method="link" ACTION="search_friend.php">
				<input class="btn" TYPE="submit" VALUE="Adicionar Amigos">
			</form>
		<?php
				try {
					$conn = new mysqli($url, $username, $password, $dbname);

					if ($conn->connect_error) {
						throw new Exception($conn->connect_error);
					}else {
						
					}

					$currentUser = new User();
					$currentUser = $currentUser->getUser($conn, $userid);
					$relation = new Relation($conn, $currentUser);
					$friendList = $relation->getFriendsList();

					foreach ($friendList as $friend) {
						?>
								<div class='row results'>
									<div class='column-sm'>
										<img class='img-user' src='images/user-placeholder.png'>
									</div>
									<div class='column-lg'>
										<p style='text-align:left'><?php echo $relation->getFriend($friend)->getUsername()?></p>
										<button class='add-friend' data-user='<?php echo $relation->getFriend($friend)->getUserId();?>' data-action='block'>Bloquear</button>
										<button class='add-friend' data-user='<?php echo $relation->getFriend($friend)->getUserId();?>' data-action='unfriend'>Remover</button>
									</div>
								</div>
								<hr>					
						<?php
					}
					?>
					<hr>
					<h2>Solicitações Enviadas</h2>
					<?php 
						$friendRequestList = $relation->getSentFriendRequests();
						foreach ($friendRequestList as $friendRequest) {
							?>
								<div class='row results'>
									<div class='column-sm'>
										<img class='img-user' src='images/user-placeholder.png'>
									</div>
									<div class='column-lg'>
										<p style='text-align:left'><?php echo $relation->getFriend($friendRequest)->getUsername();?></p>
										<button class='add-friend' data-user='<?php echo $relation->getFriend($friendRequest)->getUserId();?>' data-action='cancel'>Cancelar Solicitação</button>
									</div>
								</div>
								<hr>								
							<?php
						}					
					?>
					<hr>
					<h2>Solicitações Recebidas</h2>
					<?php 
						$friendRequestList = $relation->getFriendRequests();
						foreach ($friendRequestList as $friendRequest) {
							?>
								<div class='row results'>
									<div class='column-sm'>
										<img class='img-user' src='images/user-placeholder.png'>
									</div>
									<div class='column-lg'>
									<p style='text-align:left'><?php echo $relation->getFriend($friendRequest)->getUsername();?></p>
										<button class='add-friend' data-user='<?php echo $relation->getFriend($friendRequest)->getUserId();?>' data-action='add'>Adicionar</button>
										<button class='add-friend' data-user='<?php echo $relation->getFriend($friendRequest)->getUserId();?>' data-action='reject'>Rejeitar</button>
									</div>
								</div>
								<hr>
							<?php
						}					
					?>
					<hr>
					<h2>Amizades Bloqueadas</h2>
					<?php 
					$blockedFriendList = $relation->getBlockedFriends();

					foreach ($blockedFriendList as $friend) {
						?>
								<div class='row results'>
									<div class='column-sm'>
										<img class='img-user' src='images/user-placeholder.png'>
									</div>
									<div class='column-lg'>
										<p style='text-align:left'><?php echo $relation->getFriend($friend)->getUsername()?></p>
										<button class='add-friend' data-user='<?php echo $relation->getFriend($friend)->getUserId();?>' data-action='unblock'>Desbloquear</button>
										<button class='add-friend' data-user='<?php echo $relation->getFriend($friend)->getUserId();?>' data-action='unfriend'>Remover</button>
									</div>
								</div>
								<hr>					
						<?php
					}
					?>										
					<?php

					$conn->close();
				}

				catch(Exception $e)
				{
					echo $e->getMessage();
				}

        ?>
        
		<p><a href="user_page.php">Voltar para Dashboard</a>
	</div>
</main>

<?php 
	include 'modules/footer.php';
?>