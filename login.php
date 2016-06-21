<?php

	//start session
	session_start();	

	//get username and password from $_POST

	$username = $_POST["username"];
	$password = $_POST["password"];

//	$password = password_hash($user_password, PASSWORD_BCRYPT); 

	$dbhost = "localhost";
	$dbuser = "root";
	//$dbpass = "root";
	$dbpass = "";
	$dbname = "myDB";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);
	if( mysqli_connect_errno($conn)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

//	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");	

	$row = mysqli_fetch_row($result);

	$num_of_rows = mysqli_num_rows($result);
	echo "$num_of_rows: ";

	//Check in the DB
	if($num_of_rows > 0 && password_verify($password, $row[2])){
		$_SESSION["username"] = $username;
		header("Location: feed.php");
	}else{
		echo "Invalid Username or Password! Try Again!";
	}

	/*if($username == "bman524" && $password == "1234"){
		echo "Success!! Welcome $username";
		//$_SESSION["username"] = $username;
	}else{
		echo "Invalid Username or Password";
	}*/


?>