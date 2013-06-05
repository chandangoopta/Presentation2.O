<?php

function check_permissions($location){
	return (substr(sprintf('%o', fileperms($location)), -4));
}

function class_autoloader($class){
	# not including other libraries class
	if(file_exists(LIB_PATH.DS.strtolower($class).'.class.php')){
		require_once(LIB_PATH.DS.strtolower($class).'.class.php');
	}
}

function redirect_to($location = null){
	if($location != null){
		header("Location: {$location}");
		exit;
	}
}
