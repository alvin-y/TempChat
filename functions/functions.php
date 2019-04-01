<?php
	function getDB(){
		// connect to the DB and returns a reference to the DB
		$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
		if(!$conn){
			die();
		}
		return $conn;
	}
	
	function runQuery($db, $query) {
		$result = mysqli_query($db, $query);
		return $result;
		// takes a reference to the DB and a query and returns the results of running the query on the database
	}	
?>