<?php
	echo "<html><body>";
	
	$posts = new mysqli("mysql.eecs.ku.edu", "mtaylor", 'P@$$word123', "mtaylor"); //attempt to establish connection
	
	if($posts->connect_errno) { //check if connection has been established
		printf("Connetion failed: %s\n", $posts->connect_error);
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	}
	
	$username = $_POST["username"]; //get info from html form
	$post = $_POST["post"];
	
	if(strlen($post) == 0) { //check if post was blank
		echo "Error! Post cannot be blank";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	}
	
	$query = "SELECT * FROM Users WHERE username='" . $username . "'";
	$result = $posts->query($query);
	if($result->num_rows == 0) { //check if given username has been created
		echo "Error! " . $username . " is not an existing username.";
		echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
		exit();
	} else { //if username is valid, add post to table
		$insert = "INSERT INTO Posts (content, author_id) VALUES ('" . $post . "', (SELECT user_id FROM Users WHERE username='" . $username . "'))";
		$posts->query($insert);
		echo "Post successfully added!";
	}
	$posts->close();
	echo "<br><br><a href='AdminHome.html'><button>Return to menu</button></a></body></html>";
?>