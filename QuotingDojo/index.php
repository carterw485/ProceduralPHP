<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Add a quote</title>
	<meta name="description" content="add a quote to a wall"/>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div id="wrapper">
		<h1>Welcome to QuotingDojo</h1>
		<?php if(isset($_SESSION['empty'])){ ?>
		<p class="error"><?= $_SESSION['empty']; ?></p>
		<?php } ?>
		<form action="process.php" method="post">
			<ul>
				<li>Your name: <input type="text" name="name"></li>
				<li>Your quote: <input class="quote" type="text" name="quote"></li>
				<li class="buttons"><input type="submit" name="add" value="Add your quote"><input type="submit" name="skip" value="Skip to the quotes"></li>
			</ul>
		</form>
		<form action="process.php" method="post">
			<input type="submit" name="reset" value="Reset">
		</form>
	</div>
</body>
</html>
<?php $_SESSION = array(); ?>
		