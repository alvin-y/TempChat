<?php

//send_chat.php

include 'functions/functions.php';
$conn = getDB();

session_start();

$dbcon = getDB();
$roomID = $_SESSION["roomID"];

$statement = $conn->prepare("SELECT  rl.msg, rl.isGif, u.name FROM roomlogs AS rl 
JOIN users AS u ON rl.senderID = u.userID 
WHERE ? = rl.roomID SORT BY rl.msgID ASC");
$statement->bind_param("i", $roomID);
$statement->execute();
$result = $statement->get_result();

$a = [];
while($row = mysqli_fetch_assoc($result)){
	$a[] = array(utf8_encode($row["msg"]),utf8_encode($row["name"]),utf8_encode($row["isGif"]) );
}

echo json_encode($a);

?>