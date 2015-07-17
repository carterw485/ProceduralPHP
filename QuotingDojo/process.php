<?php
session_start();
require_once('connection.php');
if(isset($_POST['reset'])){
	session_destroy();
	header('Location: index.php');
}
if(isset($_POST['skip'])){
	//don't add anything, skip to quotes
	header('Location: main.php');
	die('dead');
}
if(isset($_POST['add']) && !empty($_POST['name']) && !empty($_POST['quote'])){
	//add quote, then go to quotes
	$query = "INSERT INTO users (name, quote, created_at, updated_at) VALUES ('{$_POST['name']}', '{$_POST['quote']}', NOW(), NOW())";
	run_mysql_query($query);
	$grab = fetch("SELECT * FROM users");
	var_dump($query);
	var_dump($grab);
	header('Location: main.php');
}
else{
	$_SESSION['empty'] = 'One or more of the fields was left blank. Please fill them in, or use the skip to quotes button.';
	header('Location: index.php');
}
die('dead');
?>