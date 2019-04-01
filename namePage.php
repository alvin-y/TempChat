<?php
	session_start();
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = trim($_POST["screenName"]);
		if($username == ""){
			$username = "guest";
		}
		
		$_SESSION["name"] = $username;
		
		header("Location: startPage.php");
	}
?>

<html>
	<head>
		<title> TempChat </title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/nameStyle.css">
		<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
		<meta charset="UTF-8">
	</head>
	<body>
		<div class="vertical-center">
			<div class="jumbotron row">
				<div class="col-sm row">
					<h1 class="display-4 col-sm-5">TempChat</h1>
				</div>
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="col-sm-7 row">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Display Name" name="screenName">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="submit">Enter</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>