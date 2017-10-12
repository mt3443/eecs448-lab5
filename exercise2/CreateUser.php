<?php
	echo "<html><body>";
	$userIDs = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor");
	
	if($userIDs->connect_errno) {
		printf("Connetion failed: %s\n", $userIDs->connect_error);
		exit();
	}
	
	$username = $_POST["username"];
	
	if(strlen($username) == 0) {
		echo "Error! Username cannot be blank";
		exit();
	}
	
	$query = "SELECT * FROM Users WHERE user_id='" + $username + "'";
	
	if($userIDs->query($query)) {
		echo "Error! The username, " + $username + ", is already in use";
		exit();
	} else {
		$insert = "INSERT INTO Users (" + $username + ");";
		$userIDs->query($insert);
		echo "Username successfully added!";
	}
	
	$userIDs->close();
	
	echo "</body></html>";
	
?>
