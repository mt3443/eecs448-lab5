<?php

	$userIDs = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor"); //attempt to establish a connection
	
	if($userIDs->connect_errno) { //check if connection has been established
		printf("Connetion failed: %s\n", $userIDs->connect_error);
		exit();
	}

	echo "<html><body>";
	
	$result = $userIDs->query("SELECT * FROM Users");
	
	if($result->num_rows == 0) { //if table of users is empty
		echo "<h3>There are no users</h3>";
	} else { //if not, print all users;
		echo "<h3>Users:</h3>";
		while($row = mysqli_fetch_array($result)) {
			echo "<br>" . $row['username'];
		}
	}
	
	$userIDs->close();
	echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";

?>