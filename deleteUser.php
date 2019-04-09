<?php
include 'functions/functions.php';
$conn = getDB();

//deleteUser.php
session_start();

$userID = $_SESSION["userID"];

$statement = $conn->prepare('DELETE FROM users WHERE userID = ?;');
$statement->bind_param("i", $userID);
$statement->execute();

header("Location: namePage.php");
session_destroy();
?>