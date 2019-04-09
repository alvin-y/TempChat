<?php
	session_start();
	
	include 'functions/functions.php';
	$conn = getDB();
	
	if(!isset($_SESSION["name"])){
		header("Location: namePage.php");
	}
	
	$userID = $_SESSION["userID"];
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['create'])) {     //MAKE NEW ROOM
			//create-button was clicked
			$id = mt_rand(0,10000);
			
			//check if room already exists
			$statement = $conn->prepare("SELECT id FROM rooms WHERE id = ?");
			$statement->bind_param("i", $id);
			$statement->execute();
			$result = $statement->get_result();
			//if room ID in use.
			while(mysqli_num_rows($result) == 1) {
				$id = mt_rand(0,10000);
				$statement = $conn->prepare("SELECT id FROM rooms WHERE id = ?");
				$statement->bind_param("i", $id);
				$statement->execute();
				$result = $statement->get_result();
			}
			//hash the password and insert info into room
			$newPass = password_hash(trim($_POST["roomPassMake"]), PASSWORD_DEFAULT);
			
			$statement = $conn->prepare('INSERT INTO rooms (id, roomPass, userCount) VALUES (?, ?, ?)');
			$temp = 1;
			$statement->bind_param("isi", $id, $newPass, $temp);
			$statement->execute();
			
			$statement = $conn->prepare('INSERT INTO roomusers (roomID, userID) VALUES (?, ?)');
			$statement->bind_param("ii", $id, $userID);
			$statement->execute();		
			
			$_SESSION["roomID"] = $id;
		
			header("Location: chatPage.php");
		}
		elseif (isset($_POST['join'])) {      //JOIN ROOM
			# join-button was clicked
			$id = $_POST["roomID"];
			$statement = $conn->prepare("SELECT id FROM rooms WHERE id = ?");
			$statement->bind_param("i", $id);
			$statement->execute();
			$result = $statement->get_result();
			
			if(mysqli_num_rows($result) == 0){ //room doesn't exist
				echo '<script type="text/javascript"> alert("This room does not exist"); </script>';
				
			} else { //check password
				$id = $_POST["roomID"];
				$roomPass = $_POST["roomPassJoin"];
				$statement = $conn->prepare("SELECT roomPass FROM rooms WHERE id = ?");
				$statement->bind_param("i", $id);
				$statement->execute();
				$result = $statement->get_result();
				$passCheck = mysqli_fetch_assoc($result)["roomPass"];
				
				if(password_verify($roomPass, $passCheck)){ //if password matches
					//check if user already exists
					$statement = $conn->prepare("SELECT userID FROM roomusers WHERE (roomID = ? AND userID = ?)");
					$statement->bind_param("ii", $id, $userID);
					$statement->execute();
					$result = $statement->get_result();	
					echo mysqli_fetch_assoc($result)["userID"];
					if(mysqli_num_rows($result) == 0){ //not already in room
						$statement = $conn->prepare('INSERT INTO roomusers (roomID, userID) VALUES (?, ?)');
						$statement->bind_param("ii", $id, $userID);
						$statement->execute();	
						
						$statement = $conn->prepare('UPDATE rooms SET userCount = userCount + 1 WHERE id = ?');
						$statement->bind_param("i", $id);
						$statement->execute();
					}
					$_SESSION["roomID"] = $id;
					header("Location: chatPage.php");
				} else { //wrong password
					echo '<script type="text/javascript"> alert("Invalid Password"); </script>';
				}
			}
		}
	}
?>

<html>
	<head>
		<title> TempChat </title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/startStyle.css">
		<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
		<meta charset="UTF-8">
	</head>
	<body>
		<div class="vertical-center">
			<div class="jumbotron">
				<h1 class="display-4 col-sm-5">TempChat</h1>
				<br>
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="form-group row">
					<div class="col-sm">
						<button class="btn btn-primary btn-lg btn-block" name="create">Create new room</button>
						<input type="password" class="form-control-lg" placeholder="Make a password" name="roomPassMake">
					</div>
					
					<div class="col-sm input-group">
						<input type="number" min="0" max="10000" class="form-control-lg col-sm-7" placeholder="Room ID" name="roomID">
						<input type="password" class="form-control-lg col-sm-7" placeholder="Enter Password" name="roomPassJoin">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary btn-lg btn-block" name="join">Join by ID</button>
						</div>
					</div>
				</form>

				<div id="errorBox">
				</div>
			</div>
		</div>
	</body>
</html>