<?php
	function getDB(){
		// connect to the DB and returns a reference to the DB
		$conn = mysqli_connect("localhost", "root", "", "tempchat");
		if(!$conn){
			die();
			echo "db fail";
		}
		return $conn;
	}
	
	function runQuery($db, $query) {
		$result = mysqli_query($db, $query);
		return $result;
		// takes a reference to the DB and a query and returns the results of running the query on the database
	}	
	
	function fetch_user_chat($room, $user, $conn){
		$query = "
		SELECT * FROM roomlogs
		WHERE (from roomID = '".$room."'
		AND senderID = '".$user."')
		ORDER BY msgID ASC
		";
		$statement = $conn->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '<ul class="list-unstyled">';
		foreach($result as $row)
		{
			$username = '';
			if($row["senderID"] == $user)
				$username= '<b class="text-success">you</b>';
			
			
		}
	}
	
	function get_username($userID, $conn){
		$query = "SELECT name FROM users
		WHERE userID = '$userID'";
		$statement = $conn->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
			return $row['name'];
		}
	}
	
?>