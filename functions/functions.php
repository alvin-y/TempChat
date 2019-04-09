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
?>