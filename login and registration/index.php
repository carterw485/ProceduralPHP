<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Login and registration</title>
	<meta name="description" content="description"/>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div id="wrapper">
		<?php if(isset($_SESSION['errors'])){ ?>
		<div class="errorlog">
		<?php 	foreach($_SESSION['errors'] as $errors => $error){ ?>
					<p><?= $error; ?></p>
		<?php 	} ?>
		</div>
		<?php $_SESSION['errors'] = array(); ?>
		<?php } ?>
		<?php if(isset($_SESSION['success'])){ ?>
				<div class="success">
					<p><?= $_SESSION['success']; ?></p>
				</div>
				<?php $_SESSION['success'] = null; ?>
		<?php } ?>
		<form action="process.php" method="post">
			<fieldset>
				<legend>Registration</legend>

				<label>First Name: <input type="text" name="first_name"></label>
				<label>Last Name: <input type="text" name="last_name"></label>
				<label>Email: <input type="text" name="email"></label>
				<label>Password: <input type="password" name="password"></label>
				<label>Confirm Password: <input type="password" name="pass_conf"></label>
				<input type="hidden" name="action" value="register">
				<input type="submit" value="Create your account">
			</fieldset>
		</form>
		<form action="process.php" method="post">
			<fieldset>
				<legend>Log in</legend>
				<label>Email: <input type="text" name="email"></label>
				<label>Password: <input type="password" name="password"></label>
				<input type="hidden" name="action" value="login">
				<input type="submit" value="Log in">
			</fieldset>
		</form>
	</div>
</body>
</html>
		