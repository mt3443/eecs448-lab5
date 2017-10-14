<?php

	$connection = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor"); //attempt to establish connection
	
	if($connection->connect_errno) { //check if connection has been established
		printf("Connetion failed: %s\n", $connection->connect_error);
		exit();
	}
	
	echo "<html><body>";
	
	$user = $_POST['choice']; //get info from html form
	$query = "SELECT * FROM Users WHERE username='" . $user . "'";
	$result = $connection->query($query);
	$row = $result->fetch_assoc();
	$author = $row["user_id"];

	$result = $connection->query("SELECT content FROM Posts WHERE author_id='" . $author . "'");
	
	if($result->num_rows == 0) { //check if selected user has no posts
		echo "<h3>" . $user . " does not have any posts</h3>";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a>";
	} else { //if selected user has posts, print all posts
		echo "<h3>" . $user . "'s posts</h3>";
		
		while($row = $result->fetch_assoc()) {
			echo "<br>" . $row["content"] . "<br><br>";
		}
		
		echo "<br><a href='AdminHome.html'><button>Return to menu</button></a>";
	}
	
	$connection->close();
	echo "</body></html>";
?>