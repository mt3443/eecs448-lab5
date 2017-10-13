<?php

	$userIDs = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor");
	
	if($userIDs->connect_errno) {
		printf("Connetion failed: %s\n", $userIDs->connect_error);
		exit();
	}
	
	
	echo "<html><body>";
	
	$username = $_POST["username"];
	
	if(strlen($username) == 0) {
		echo "Error! Username cannot be blank";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	}
	
	$query = "SELECT * FROM Users WHERE username='" . $username . "'";
	$result = $userIDs->query($query);
	if($result->num_rows != 0) {
		echo "Error! The username, " . $username . ", is already in use";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	} else {
		$insert = "INSERT INTO Users (username) VALUES ('" . $username . "')";
		$userIDs->query($insert);
		echo "Username successfully added!";
	}
	
	$userIDs->close();
	echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
?>