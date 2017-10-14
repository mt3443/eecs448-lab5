<?php

	$connection = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor");
	
	if($connection->connect_errno) {
		printf("Connetion failed: %s\n", $connection->connect_error);
		exit();
	}
	
	echo "<html><body>";
	
	$user = $_POST['choice'];
	$query = "SELECT * FROM Users WHERE username='" . $user . "'";
	$result = $connection->query($query);
	$row = $result->fetch_assoc();
	$author = $row["user_id"];

	$result = $connection->query("SELECT content FROM Posts WHERE author_id='" . $author . "'");
	
	if($result->num_rows == 0) {
		echo "<h3>" . $user . " does not have any posts</h3>";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a>";
	} else {
		echo "<h3>" . $user . "'s posts</h3>";
		
		while($row = $result->fetch_assoc()) {
			echo "<br>" . $row["content"] . "<br><br>";
		}
		
		echo "<br><a href='AdminHome.html'><button>Return to menu</button></a>";
	}
	
	$connection->close();
	echo "</body></html>";
?>