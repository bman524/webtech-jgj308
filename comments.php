<?php

	session_start();

	include('database.php');
	include('functions.php');

	$comment = $_POST['comment'];
	$PID = $_POST['PID'];
	$UID = $_POST['UID'];

	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
	$row = mysqli_fetch_assoc($result);

	//Fetch user info
	$user = $row["Name"];

	//Sanitize Input
	sanitizeString($PID);
	sanitizeString($comment);
	sanitizeString($UID);
	sanitizeString($user);
	
	$result_insert = mysqli_query($conn, "INSERT INTO comments(PID, comment, UID, user) VALUES ('$PID', '$comment', '$UID', '$user')");		

	//Check if insert was ok
	if($result_insert){
	//redirect to feed page
		header("Location: feed.php");
	}else{
		//throw an error
		echo "Oops! Something went wrong! Please try again!";
	}

?>