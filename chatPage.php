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
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
					<table id="chat">
						
					</table>
			</div>
			
			<form id="chat" class="userChat" method = 'POST'>
				<div class="input-group">
					<input type="text" class="form-control" id = "message"  name="message" value="" placeholder="Message" autofocus>
					<div class="input-group-append">
						<button type="submit" class="btn btn-outline-secondary" id="send">Send</button>
					</div>
				</div>
			</form>
			
			<div class="row">
			
		</div>
		
		<div class ="userList">
		<h5>User List:</h5>
		</div>
		<script src="js/chatroom.js"></script>
	</body>
	
</html>
