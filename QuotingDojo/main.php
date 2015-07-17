<?php
session_start();
require_once('connection.php');
$query = "SELECT name, quote, created_at FROM users";
$data = fetch($query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>viewquotes</title>
	<meta name="description" content="view quotes from index"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div id="wrapper">
		<h1>Here are the awesome quotes!</h1>
		<div class="quotes">
			<?php foreach($data as $user){ ?>
			<div class="quote">
				<h2>"<?= $user['quote']; ?>"</h2>
				<?php $date = date_create($user['created_at']); ?>
				<h3>- <?= $user['name'] . ' at ' . date_format($date, 'g:ia M d Y'); ?></h3>
			</div>
			<?php } ?>
		</div>
	</div>
</body>
</html>
		