<?php
	$connection = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor");
	
	if($connection->connect_errno) {
		printf("Connetion failed: %s\n", $connection->connect_error);
		exit();
	}
	
	echo "<html><body>";
	
	$posts = $connection->query("SELECT * FROM Posts");
	$check = false;
	while($row = $posts->fetch_assoc()) {
		if(isset($_POST[$row['post_id']])) {
			$check = true;
		}
	}
	
	if(!$check) {
		echo "<h3>Error! You must select at least one post to delete</h3><br><br><a href='AdminHome.html'><button>Return to menu</button></a>";
		exit();
	}
	
	$posts = $connection->query("SELECT * FROM Posts");
	
	echo "<h3>Success! The IDs of the deleted posts are shown below</h3>";
	
	while($row = $posts->fetch_assoc()) {
		if(isset($_POST[$row['post_id']])) {
			echo $row['post_id'] . "<br>";
			$delete = "DELETE FROM Posts WHERE post_id='" . $row['post_id'] . "'";
			$connection->query($delete);
		}
	}
	
	echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a>";
?>