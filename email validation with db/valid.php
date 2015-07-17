<?php
session_start();
include('new-connection.php');
$query = "SELECT * FROM users";
$users = fetch($query);
$length = count($users);
$delete = "DELETE FROM users WHERE id = $length";
$autoincrement = "ALTER TABLE users AUTO_INCREMENT = $length";
if(isset($_POST['deleterow'])){
	run_mysql_query($delete);
	run_mysql_query($autoincrement);
}
?>
<h1>The email address you entered <?= $_SESSION['email'] ?> is a valid email address! Thank you!</h1>
<form action="valid.php" method="post">
	<input type="submit" name="deleterow" value="Delete an email">
</form>
<?php var_dump($users); ?>