<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');
require_once(LIB_PATH.DS.'authenticate.inc.php');


if( (isset($_GET['file'])) && (isset($_GET['slide'])) && (isset($_GET['block']))){
	$purifier = new HTMLPurifier();
	$file = $purifier->purify($_GET['file']);
	$slide = $purifier->purify($_GET['slide']);
	$block = $purifier->purify($_GET['block']);

	$content = $file.':|:'.$slide.':|:'.$block;
	if(!Slide::changeCurrentSlide($content)){
		Log::log_action("Current Slide could not be configured");
		die("Current Slide could not be configured");
	}
	redirect_to('presentation.php');
}
?>
