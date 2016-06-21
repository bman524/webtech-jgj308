<?php

	session_start();

	include('database.php');
	include('functions.php');

	$content = $_POST['content'];
	$UID = $_POST['UID'];

	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
	$row = mysqli_fetch_assoc($result);

	//Fetch user info
	$name = $row["Name"];
	$profile_pic = $row["profile_pic"];

	echo "$name";

	//Sanitize Input
	sanitizeString($content);
	sanitizeString($UID);
	sanitizeString($name);
	sanitizeString($profile_pic);

	$result_insert = mysqli_query($conn, "INSERT INTO posts(content, UID, name, profile_pic, likes) VALUES ('$content', '$UID', '$name', '$profile_pic', 0)");	

	//Check if insert was ok
	if($result_insert){
	//redirect to feed page
		header("Location: feed.php");
	}else{
		//throw an error
		echo "Oops! Something went wrong! Please try again!";
	}

?>