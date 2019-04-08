<?php
	session_start();
	
	include 'functions/functions.php';
	$conn = getDB();
	
	if(!isset($_SESSION["name"])){
		header("Location: namePage.php");
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['create'])) {
			# create-button was clicked
			$id = mt_rand(0,10000);
		}
		elseif (isset($_POST['join'])) {
			# join-button was clicked
			$id = $_POST["roomID"];
		}
		
		$_SESSION["roomID"] = $id;
		
		header("Location: chatPage.php");
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