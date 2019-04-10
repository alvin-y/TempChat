<?php

//roomStatus.php

include 'functions/functions.php';
$conn = getDB();

session_start();

$roomID = $_SESSION["roomID"];

$statement = $conn->prepare("SELECT id FROM rooms WHERE ? = id");
$statement->bind_param("i", $roomID);
$statement->execute();
$result = $statement->get_result();

$a = [];
while($row = mysqli_fetch_assoc($result)){
	$a[] = utf8_encode($row["id"]);
}

echo json_encode($a);

?>