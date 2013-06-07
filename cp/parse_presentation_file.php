<?php

header('content-type: application/json; charset=utf-8');

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');

if( isset($_GET['loc'])){
	$purifier = new HTMLPurifier();
	$loc = $purifier->purify($_GET['loc']);
	Parser::parse();
	$json = Parser::$parseResult;
	if($loc==0){
		$json  = str_replace('presentations/images/', '../presentations/images/', $json);
	}
	echo $json;
}else{
	Log::log_action("Could not get location");
	die("Could not get location");
}


