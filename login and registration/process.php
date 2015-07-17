<?php
session_start();
require_once('connection.php');
$errors = array();
function alphaOnly($string){
	for($i=0 ; $i<strlen($string) ; $i++){
		if(is_numeric($string[$i])){
			return false;
		}
	}
	return true;
}
if(isset($_POST['action']) && $_POST['action'] === 'register'){
	if(strlen($_POST['first_name']) < 1 || !alphaOnly($_POST['first_name'])){
		$errors[] = "First name is required / can not contain numbers";
	}
	if(strlen($_POST['last_name']) < 1 || !alphaOnly($_POST['last_name'])){
		$errors[] = "last name is required / can not contain numbers";
	}
	if(strlen($_POST['email']) < 1){
		$errors[] = "Email is required";
	}
	else{
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
			$errors[] = "Invalid email address.";
		}
		$esc_email = mysqli_real_escape_string($connection, $_POST['email']);
		$esc_email = strtolower($esc_email);
		$check_for_email = "SELECT * FROM users WHERE email = '{$esc_email}'";
		$checking = fetch($check_for_email);
		if(count($checking) > 0){
			$errors[] = "A user with that email already exists";
		}
	}
	if(strlen($_POST['password']) < 1){
		$errors[] = "Password field is required.";
	}
	if($_POST['password'] != $_POST['pass_conf']){
		$errors[] = "Passwords must match.";
	}
	if(count($errors) > 0){
		$_SESSION['errors'] = array();
			foreach($errors as $error){
			$_SESSION['errors'][] = $error;
			header('Location: index.php');
		}
	}
	else{
		//escape stuff, then insert with a query
		$esc_first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
		$esc_last_name = mysqli_real_escape_string($connection, $_POST['last_name']);

		$salt = bin2hex(openssl_random_pseudo_bytes(22));
		$encrypted_password = md5($_POST['password'] . '' . $salt);

		$query = "INSERT INTO users (first_name, last_name, email, password, salt, created_at, updated_at)
					VALUES ('{$esc_first_name}', '{$esc_last_name}', '{$esc_email}', '{$encrypted_password}', '$salt', NOW(), NOW())";
		if(run_mysql_query($query))
		{
			$_SESSION['success'] = "Successfully Registered! Please login to continue.";
			header("Location: index.php");
			exit();
		}
		else
		{
			$_SESSION['errors'] = array("Adding user to the DB failed for some reason :(");
			header("Location: index.php");
			exit();
		} 
	}
}
if(isset($_POST['action']) && $_POST['action'] == "login")
{
	if(strlen($_POST['email']) < 1)
	{
		$_SESSION['badlogin'] = "bad log in.";
	}

	if(strlen($_POST['password']) < 1)
	{
		$_SESSION['badlogin'] = "bad log in.";
	}

	if(isset($_SESSION['badlogin'])){
		$_SESSION['errors'] = $errors;
		header("Location: index.php");
		exit();
	}
	else
	{
		$esc_email = mysqli_real_escape_string($connection, $_POST['email']);
		$esc_email = strtolower($esc_email);

		$query = "SELECT * FROM users WHERE email='{$esc_email}'";

		$user = fetch($query);

		if(!empty($user))
		{
			$encrypted_password = md5($_POST['password'] . '' . $user['salt']);
			if($encrypted_password != $user['password'])
			{
				$_SESSION['errors'] = array("Bad login credentials. (pass)");
				header("Location: index.php");
				exit();
			}
			elseif($encrypted_password == $user['password'])
			{
				$_SESSION['success'] = "Login successful!";

				$_SESSION['logged_user'] = array("id" => $user['id'], "first_name" => $user['first_name']);

				header("Location: success.php");
				exit();
			}
			else
			{
				die("something else happened.");
			}
		}
		else
		{
			$_SESSION['errors'] = array("Bad login credentials.");
			header("Location: index.php");
			exit();
		}
	}

}
?>