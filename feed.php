<html>
<head>
	<title>MyFaceBook Feed</title>
</head>
<body>

<?php
	include('database.php');

	session_start();

	$conn = connect_db();
	//database.php replaces this block of code

	/*
	$dbhost = "localhost";
	$dbuser = "root";
	//$dbpass = "root";
	$dbpass = "";
	$dbname = "myDB";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	*/

	$username = $_SESSION["username"];

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	$row = mysqli_fetch_row($result);

//	echo "<h1>Welcome back $username!</h1>";
	echo "<h1>Welcome back $row[3]!</h1>";
//	echo "<h1>Welcome back ".$row['name']."!</h1>";
//	echo "<img src='".$row['profile_pic']."'>";
	echo "<img src='".$row[10]."'>";
	echo "<hr>";

	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Say something...</textarea></p>";
//	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<input type='hidden' name='UID' value='$row[0]'>";
	echo "<p><input type='submit'></p>";
	echo "</form>";

	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0){
		echo "<p>No new posts to show!</p>";
	}

	//Show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){
		$psts_row = mysqli_fetch_row($result_posts);
		echo "$psts_row[3] said $psts_row[1] ($psts_row[5])";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$psts_row[0]'> <input type='submit' value='Like'></form>";

		echo "<form action='comments.php' method='POST'>";
		echo "<input type='hidden' name='PID' value='$psts_row[0]'>";
		echo "<input type='hidden' name='UID' value='$row[0]'>";
		echo "<p><textarea name='comment'>Comment something...</textarea></p>";
		echo "<p><input type='submit'></p>";
		echo "</form>";
//		echo "<br>";

		$result_comments = mysqli_query($conn, "SELECT * FROM comments WHERE PID='$psts_row[0]'");
		$num_of_cmts_rows = mysqli_num_rows($result_comments);
		for($j=0; $j < $num_of_cmts_rows; $j++){
			$cmts_row = mysqli_fetch_row($result_comments);
			echo "$cmts_row[4] commented: $cmts_row[2]";
			echo "<br>";
		}
		echo "<br>";
	}

?>


</body>
</html>













