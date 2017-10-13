<?php
	echo "<html><body>";
	
	$posts = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor");
	
	if($posts->connect_errno) {
		printf("Connetion failed: %s\n", $posts->connect_error);
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	}
	
	$username = $_POST["username"];
	$post = $_POST["post"];
	
	if(strlen($post) == 0) {
		echo "Error! Post cannot be blank";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	}
	
	$query = "SELECT * FROM Users WHERE username='" . $username . "'";
	$result = $posts->query($query);
	if($result->num_rows == 0) {
		echo "Error! " . $username . " is not an existing username.";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	} else {
		$insert = "INSERT INTO Posts (content, author_id) VALUES ('" . $post . "', (SELECT user_id FROM Users WHERE username='" . $username . "'))";
		$posts->query($insert);
		echo "Post successfully added!";
	}
	$posts->close();
	echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
?>