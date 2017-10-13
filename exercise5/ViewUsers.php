<?php

	$userIDs = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor");
	
	if($userIDs->connect_errno) {
		printf("Connetion failed: %s\n", $userIDs->connect_error);
		exit();
	}

	echo "<html><body>";
	
	$result = $userIDs->query("SELECT * FROM Users");
	
	if($result->num_rows == 0) {
		echo "<h3>There are no users</h3>";
	} else {
		echo "<h3>Users:</h3>";
		while($row = mysqli_fetch_array($result)) {
			echo "<br>" . $row['username'];
		}
	}
	
	$userIDs->close();
	echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";

?>