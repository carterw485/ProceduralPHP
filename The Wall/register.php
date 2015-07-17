<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>The Wall</title>
    <meta name="description" content="The wall"/>
    <link rel="stylesheet" type="text/css" href="register.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
</head>
<body>
	<div class="container">
	    <form class="form-signin" action="process.php" method="post">
			<h2 class="form-signin-heading">Account registration</h2>
			<?php if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){ ?>
				<div class='errors alert alert-danger'>
					<ul>
					<?php foreach($_SESSION['errors'] as $error){ ?>
						<li><?= $error ?></li>
					<?php } ?>
					</ul>
				</div>
				<?php $_SESSION['errors'] = array(); ?>
			<?php } ?>
			<?php if(isset($_SESSION['success']) && !empty($_SESSION['success'])){ ?>
				<div class='errors alert alert-success'>
					<p><?= $_SESSION['success']; ?></p>
					<p>Head back to the main page to continue</p>
				</div>
				<?php unset($_SESSION['success']); ?>
			<?php } ?>
			<ul class="form">
				<li>First Name: <input type="text" class="form-control" name="first_name"></li>
				<li>Last Name: <input type="text" class="form-control" name="last_name"></li>
				<li>Email: <input type="text" class="form-control" name="email"></li>
				<li>Password: <input type="password" class="form-control" name="password"></li>
				<li>Confirm Password: <input type="password" class="form-control" name="confpassword"></li>
			</ul>
			<p class="button"><input class="btn btn-lg btn-success" type="submit" value="Create your account" name="registration"></p>
	    </form>
	</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="hover.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>	
</body>
</html>