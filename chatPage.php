<?php
	session_start();
	
	if(!isset($_SESSION["name"])){
		header("Location: namePage.php");
	}
	$user = $_SESSION["name"];
	$roomID = $_SESSION["roomID"];
?>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/chatStyle.css">
		<link rel="stylesheet" href="css/startStyle.css">
		<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
		<title> TempChat | Room: <?php echo $roomID ?> </title>
	</head>

	<body>
	<?php echo "<input type='hidden' id='username' value='$user' />"; ?>
		<div class="mainBox">
			<div class="IDBar" id="IDBar">
				<h2 id="roomID">Room ID: <?php echo $roomID ?></h2>
			</div>

			<div class="chatBox" id="chatBox" style="overflow-y:scroll;">

			</div>
			
			<form id="chat" class="userChat" method = 'POST'>
				<input type="text" class="textInput" id = "message"  name="message" value="" placeholder="Message" autofocus>
				<input type="submit" class="submit" id="send"></input>
			</form>
		
		</div>
		
		<div class ="userList">
		<h5>User List:</h5>
		</div>
		<script src="js/chatroom.js"></script>
	</body>
	
</html>
