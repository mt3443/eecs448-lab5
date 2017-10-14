<?php

	$userIDs = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor"); //attempt to establish connection
	
	if($userIDs->connect_errno) { //check if error has been established
		printf("Connetion failed: %s\n", $userIDs->connect_error);
		exit();
	}
	
	
	echo "<html><body>";
	
	$username = $_POST["username"]; //get information from html form
	
	if(strlen($username) == 0) { //check if input field was blank
		echo "Error! Username cannot be blank";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	}
	
	$query = "SELECT * FROM Users WHERE username='" . $username . "'";
	$result = $userIDs->query($query);
	if($result->num_rows != 0) { //check if given username already exists
		echo "Error! The username, " . $username . ", is already in use";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	} else { //if not, add it to the table
		$insert = "INSERT INTO Users (username) VALUES ('" . $username . "')";
		$userIDs->query($insert);
		echo "Username successfully added!";
	}
	
	$userIDs->close();
	echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
?>