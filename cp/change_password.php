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
$values['includes']='';
$values['header'] = 'Presentation 2.O';
$values['body'] = '
	<div id="changepass">
		<form method="post" action="'.$_SERVER['PHP_SELF'].'">
			<div id="message">
				'.$message.'
			</div>
			<label for="oldpass">Old Password:</label>
			<input name="password" id="oldpass" type="password">
			<label for="newpass">New password:</label>
			<input name="new_password" id="newpass" type="password">
			<input type="submit" name="submit" value="Change">
		</form>
	</div>';
$values['footer'] = '| <a href="logout.php">Logout</a>';
echo $Mustache->render($cp_page_template, $values); 
