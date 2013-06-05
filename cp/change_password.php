<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');
require_once(LIB_PATH.DS.'authenticate.inc.php');


$message = 'Change app password';
if(isset($_POST['submit'])){
	$purifier = new HTMLPurifier();
	$password = $purifier->purify($_POST['password']);
	$new_password = $purifier->purify($_POST['new_password']);

	$auth = User::authenticate($password);

	if($auth){
		if(User::changePassword($new_password)){
			$message = 'Password changed sucessfully';
		}else{
			$message = 'Error changing password';
		}
	}else{
		$message = "Invalid! old password";
	}
}

$values = array();
$values['body'] = '
		<div id="message">
			'.$message.'
		</div>
		<form method="post" action="'.$_SERVER['PHP_SELF'].'">
			Old Password:<input name="password" type="password">
			New password:<input name="new_password" type="password">
			<input type="submit" name="submit" value="Change">
		</form>';
$values['footer'] = '<a href="logout.php">Logout</a> | <a href="presentations_list.php">Presentations</a>';
echo $Mustache->render($cp_page_template, $values); 
