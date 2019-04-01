<?php
	session_start();
	
	if(!isset($_SESSION["name"])){
		header("Location: namePage.php");
	}
?>

<html>
	<head>
		<title> Chat Room </title>
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
				<div class="row">
					<div class="col-sm">
						<button class="btn btn-primary btn-lg btn-block">Create new room</button>
					</div>
					
					<div class="col-sm">
						<input type="text" class="form-control" placeholder="Room ID" name="roomID">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary btn-lg btn-block">Join by ID</button>
						</div>
					</div>
				</div>

			</div>
		</div>
	</body>

</html>