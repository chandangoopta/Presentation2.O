<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');

if($session->is_logged_in()){
	redirect_to('presentations_list.php');
}


$message = 'Please enter password';
if(isset($_POST['submit'])){
	$purifier = new HTMLPurifier();
	$password = $purifier->purify($_POST['password']);

	$auth = User::authenticate($password);

	$user_ip = $_SERVER['REMOTE_ADDR'];
	if($auth){
		$session->login($auth);
		Log::log_action('Login', "{$user_ip} is logged in");
		redirect_to('presentations_list.php');
	}else{
		Log::log_action('Login', "{$user_ip} attempts to login");	
		$message = "Invalid! password";
	}
}

$values = array();
$values['includes']='';
$values['header'] = 'Presentation 2.O';
$values['body'] = '
	<div id="login-form">
		<form method="post" action="'.$_SERVER['PHP_SELF'].'">
		<div id="message">
			'.$message.'
		</div>
			<input name="password" type="password">
			<input type="submit" name="submit" value="LogIn">
		</form>
	</div>';
$values['footer'] = '';
echo $Mustache->render($cp_page_template, $values); 
