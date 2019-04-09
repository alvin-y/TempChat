<?php
include 'functions/functions.php';
$conn = getDB();

//resetChat.php
session_start();

$roomID = $_SESSION["roomID"];
$userID = $_SESSION["userID"];

$statement = $conn->prepare('DELETE FROM users WHERE userID = ?;');
$statement->bind_param("i", $userID);
$statement->execute();

$statement = $conn->prepare('DELETE FROM rooms WHERE id = ?;');
$statement->bind_param("i", $roomID);
$statement->execute();

$statement = $conn->prepare('DELETE FROM roomusers WHERE roomID = ?;');
$statement->bind_param("i", $roomID);
$statement->execute();

$statement = $conn->prepare('DELETE FROM roomlogs WHERE roomID = ?;');
$statement->bind_param("i", $roomID);
$statement->execute();

header("Location: namePage.php");
session_destroy();
?>