<?php
include 'functions/functions.php';
$conn = getDB();

session_start();

$roomID = $_SESSION["roomID"];

$statement = $conn->prepare("SELECT users.name FROM users JOIN roomusers ON users.userID = roomusers.userID WHERE roomusers.roomID = ?");
$statement->bind_param("i", $roomID);
$statement->execute();
$result = $statement->get_result();

$a = [];
while($row = mysqli_fetch_assoc($result)){
	$a[] = utf8_encode($row["name"]);
}

echo json_encode($a);

?>