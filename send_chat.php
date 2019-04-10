<?php
	//send_chat.php
	include 'functions/functions.php';
	$conn = getDB();
	session_start();
	
	$roomID = $_SESSION["roomID"];
	$userID = $_SESSION["userID"];
	$msg = $_POST["msg"];
	$isGif = $_POST["isGif"];
	
	$statement = $conn->prepare('INSERT INTO roomlogs (roomID,senderID,msg, isGif) VALUES (?,?,?,?)');
	$statement->bind_param("iisi", $roomID, $userID, $msg, $isGif);
	$statement->execute();
?>