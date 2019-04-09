<?php
include 'functions/functions.php';
$conn = getDB();

//clearChat.php
session_start();

$roomID = $_SESSION["roomID"];

$statement = $conn->prepare('DELETE FROM roomlogs WHERE roomID = ?;');
$statement->bind_param("i", $roomID);
$statement->execute();

?>