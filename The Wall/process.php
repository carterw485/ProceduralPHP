<?php
session_start();
require_once('connection.php');
function alphaOnly($string){
	for($i=0 ; $i<strlen($string) ; $i++){
		if(is_numeric($string[$i])){
			return false;
		}
	}
	return true;
}
$errors = array();
if(isset($_SESSION['id'])){

}
if(isset($_POST['registration'])){
	//create an account for the user if all info is valid and email is unique
	if(strlen($_POST['first_name']) < 1 || !alphaOnly($_POST['first_name'])){
		$errors[] = "First name field is required and must not contain numbers";
	}
	if(strlen($_POST['last_name']) < 1 || !alphaOnly($_POST['last_name'])){
		$errors[] = "Last name field is required and must not contain numbers";
	}
	if(strlen($_POST['email']) < 1){
		$errors[] = "Email field is required";
	}
	else{
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$errors[] = "Invalid email address";
		}
		$esc_email = escape($_POST['email']);
		$esc_email = strtolower($esc_email);
		$check_for_email = "SELECT * FROM users WHERE email = '{$esc_email}'";
		$checking = fetch($check_for_email);
		if(count($checking) > 0){
			$errors[] = "An account with that email address already exists";
		}
	}
	if(strlen($_POST['password']) < 1){
		$errors[] = "Password field is required";
	}
	if($_POST['confpassword'] != $_POST['password']){
		$errors[] = "Confirm password must match password";
	}

	if(!empty($errors)){
			$_SESSION['errors'] = $errors;
	}
	else{
		//escape everything, then insert into database
		$esc_first_name = escape($_POST['first_name']);
		$esc_last_name = escape($_POST['last_name']);
		$salt = bin2hex(openssl_random_pseudo_bytes(22));
		$encrypted_password = md5($_POST['password'] . $salt);

		$query = "INSERT INTO users (first_name, last_name, email, password, salt, created_at, updated_at) 
		VALUES ('{$esc_first_name}', '{$esc_last_name}', '{$esc_email}', '{$encrypted_password}', '{$salt}', NOW(), NOW())";
		run_mysql_query($query);
		$_SESSION['success'] = "You've succesfully created an account!";
		$user = fetch("SELECT id FROM users WHERE email = '{$esc_email}'");
		$_SESSION['id'] = $user[0]['id'];
		header('Location: register.php');
	}
}
if(isset($_POST['signin'])){
	//change the sign in area to display Hello "name" and add a log out button
	var_dump($_POST);
	if(strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1){
		$_SESSION['badlogin'] = "bad log in.";
	}
	$esc_email = escape($_POST['email']);
	$esc_email = strtolower($esc_email);
	$user = fetch("SELECT * FROM users WHERE email = '{$esc_email}'");
	$encrypted_password = md5($_POST['password'] . $user[0]['salt']);
	if($user[0]['password'] === $encrypted_password){
		$_SESSION['id'] = $user[0]['id'];
		header('Location: index.php');
	}
	else{
		//invalid log in
		$_SESSION['badlogin'] = "bad log in.";
	}
	if(isset($_SESSION['badlogin'])){
		header('Location: index.php');
	}
}
if(isset($_POST['signout'])){
	//sign out the current user
	unset($_SESSION['id']);
	header('Location: index.php');
}
if(isset($_POST['register'])){
	//take the user to the registration page
	header('Location: register.php');
}
if(isset($_POST['message'])){
	//create the message in the database
	$message = escape($_POST['user_message']);
	$query = "INSERT INTO messages (users_id, message, created_at, updated_at)
	VALUES ('{$_SESSION['id']}', '{$message}', NOW(), NOW())";
	if(run_mysql_query($query)){
		header('Location: index.php');
	}
	else{
		$errors[] = "Failed to add message to database for some reason";
	}
	if(isset($errors)){
		var_dump($errors);
	}
}
if(isset($_POST['comment'])){
	//create the comment in the database
	$comment = escape($_POST['user_comment']);
	$query = "INSERT INTO comments (messages_id, users_id, comment, created_at, updated_at)
	VALUES ('{$_POST['messageid']}', '{$_SESSION['id']}', '{$_POST['user_comment']}', NOW(), NOW())";
	if(run_mysql_query($query)){
		header('Location: index.php');
	}
	else{
		$errors[] = "Failed to add comment to database for some reason";
	}
	if(isset($errors)){
		var_dump($errors);
		var_dump($query);
	}
}
?>