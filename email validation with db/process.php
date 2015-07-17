<?php
	session_start();
	include('new-connection.php');
	$_SESSION['email'] = $_POST['email'];
	$email = $_POST['email'];
	$user_email = "INSERT INTO users (email, created_at, updated_at) VALUES ('$email', NOW(), NOW())";
	run_mysql_query($user_email);
	header('Location: valid.php')
?>
