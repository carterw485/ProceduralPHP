<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>email validation</title>
	<meta name="description" content="description"/>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<form action="process.php" method="post">
			Email: <input type="email" name="email">
			<input type="submit" value="Submit">
		</form>
	</div>
</body>
</html>
