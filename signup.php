<?php
	include('database.php');
	include('functions.php');

	session_start();

	$name = $_POST["name"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$dob = $_POST["dob"];
	$gender = $_POST["gender"];
	$location = $_POST["location"];
	$user_password = $_POST["password"];
	$verification_question = $_POST["verify_question"];
	$verification_answer = $_POST["verify_answer"];
	$profile_pic = $_POST["profile_pic"];
	

	$conn = connect_db();

	$password = password_hash($user_password, PASSWORD_BCRYPT);

	//Sanitize Input
	sanitizeString($name);
	sanitizeString($username);
	sanitizeString($password);
	sanitizeString($email);
	sanitizeString($dob);
	sanitizeString($gender);
	sanitizeString($verification_question);
	sanitizeString($verification_answer);
	sanitizeString($location);
	sanitizeString($profile_pic);

	$result_insert = mysqli_query($conn, "INSERT INTO users(name, username, password, email, dob, gender, verification_question, verification_answer, location, profile_pic)".
			"VALUES ('$name', '$username', '$password', '$email', '$dob', '$gender', '$verification_question', '$verification_answer', '$location', '$profile_pic')");

	header("Location: login.html");

?>