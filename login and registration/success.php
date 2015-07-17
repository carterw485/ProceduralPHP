<?php
session_start();
if(empty($_SESSION['logged_user']))
{
	$_SESSION['errors'] = array("You must be logged in to see that page!");
	header("Location: index.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>success</title>
	<meta name="description" content="logged in"/>
	<link rel="stylesheet" type="text/css" href="css/success.css">
</head>
<body>
	<h1>Welcome <?= $_SESSION['logged_user']['first_name'] ?></h1>
</body>
</html>
		