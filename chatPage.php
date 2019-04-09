<?php
	
	session_start();
	
	if(!isset($_SESSION["name"])){
		header("Location: namePage.php");
	}
	$user = $_SESSION["name"];
	$userID = $_SESSION["userID"];
	$roomID = $_SESSION["roomID"];
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$message = $_POST['message'].value;

		$statement = $conn->prepare('INSERT INTO roomlogs (roomID,senderID,msg) VALUES (?,?,?)');
		$statement->bind_param("iis", $roomID, $userID, $message);
		$statement->execute();

	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/chatStyle.css">
		<link rel="stylesheet" href="css/startStyle.css">
		<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" rel="stylesheet">
		<title> TempChat | Room: <?php echo $roomID ?> </title>
	</head>

	<body>
	<?php echo "<input type='hidden' id='username' value='$user' />"; ?>
		<br>
		<div class="mainBox">
			<!--ID BOX--->
			<nav class="navbar navbar-expand-lg navbar-light IDBar">
			  <h2 id="roomID">Room ID: <?php echo $roomID ?></h2>
			  <div class="collapse navbar-collapse">
				<div class="navbar-nav">
				  <button class="btn"><span class="oi oi-data-transfer-download"></span></button>
				  <button class="btn"><span class="oi oi-monitor"></span></button>
				  <button class="btn"><span class="oi oi-x"></span></button>
				  <button type="submit" id="gifs" class="btn"><span class="oi oi-image"></span></button>
				  <input type="text" id="gifsearch" name="giphyboy" value="" placeholder="<- Type anything and press image button" style="width:300px;">
				</div>
			  </div>
			</nav>
			
			<!--CHAT BOX--->
			<div class="chatBox" id="chatBox" style="overflow-y:scroll;">
				<table id="chat">
					
				</table>
			</div>

			<!--MESSAGE BOX--->			
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="chat" class="userChat" method = 'POST'>
				<div class="input-group">
					<input type="text" class="form-control" id = "message"  name="message" value="" placeholder="Message" autofocus>
					<div class="input-group-append">
						<button type="submit" class="btn btn-outline-secondary" id="send">Send</button>
					</div>
				</div>
			</form>
		
		</div>
		
		<div class ="userList" style="overflow-y:scroll;">
		<h5>User List:</h5>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="js/chatroom.js"></script>
	</body>
	
</html>
