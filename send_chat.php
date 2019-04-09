<?php

//send_chat.php

include 'functions/functions.php';
$conn = getDB();

session_start();

$roomID = $_SESSION["roomID"];
$userID = $_SESSION["userID"];
$msg = $_POST["msg"];



$statement = $conn->prepare('INSERT INTO roomlogs (roomID,senderID,msg) VALUES (?,?,?)');
$statement->bind_param("iis", $roomID, $userID, $msg);
$statement->execute();

?>
