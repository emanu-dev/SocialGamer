<?php

	// Start the session
	session_start();
	
	include_once 'db_conn_var.php';
	include_once 'modules/user.handler.php';
	include_once 'modules/games.handler.php';
	include_once 'modules/relationship.handler.php';
	include_once 'modules/friend.relation.handler.php'; 
	
	$userid = $_SESSION["logged_userID"];
	$friendId = $_GET['id'];
	$action = $_GET['action'];

	try {
		$conn = new mysqli($url, $username, $password, $dbname);

		if ($conn->connect_error) {
			throw new Exception($conn->connect_error);
		}

		$currentUser = new User();
		$currentUser = $currentUser->getUser($conn, $userid);

		$friend = new User();
		$friend = $friend->getUser($conn, $friendId);

		$relation = new Relation($conn, $currentUser);

		if ($action == 'add') {
			$relation->acceptFriendRequest($friend);
			echo 'Amizade Aceita';
		}else if ($action == 'reject') {
			$relation->declineFriendRequest($friend);
			echo 'Solicitação Rejeitada';		
		}else if ($action == 'block') {
			$relation->block($friend);
			echo 'Amizade Bloqueada';
		}else if ($action == 'cancel') {
			$relation->cancelFriendRequest($friend);
			echo 'Solicitação Cancelada';
		}else if ($action == 'unfriend') {
			$relation->unfriend($friend);
			echo 'Amizade Desfeita';
		}else if ($action == 'unblock') {
			$relation->unblockFriend($friend);
			echo 'Amizade Desbloqueada.';
		}

	} catch (Exception $e) {
		
	}

?>