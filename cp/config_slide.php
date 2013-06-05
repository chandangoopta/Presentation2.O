<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');
require_once(LIB_PATH.DS.'authenticate.inc.php');

if(isset($_GET['action'])){
	$purifier = new HTMLPurifier();
	$action = intval($purifier->purify($_GET['action']));
}else{
	Log::log_action("Could not config slide values");
	die("Could not config slide values");
}

Slide::extractCurrentSlideId();
$file = Slide::$presentationFilename;
$slide = Slide::$presentationSlideId;
$block = Slide::$presentationBlockId;

Parser::parse();

$p_slide = $slide;
$p_block = $block;
if($slide!=0){
	$p_slide = $slide-1;
	$p_block = -1;
}

$n_block = $block;
$n_slide = $slide;
if($block < Parser::$slide[$slide]-1){
	$n_block++;
}else if($block == Parser::$slide[$slide]-1){
	if($slide != count(Parser::$slide)-1){
		$n_slide++;
		$n_block=-1;
	}
}

if($action == 1){
	$block = $n_block;
	$slide = $n_slide;
}else if($action == 0){
	$block = $p_block;
	$slide = $p_slide;
}

$content = $file.':|:'.$slide.':|:'.$block;
if(!Slide::changeCurrentSlide($content)){
	Log::log_action("Current Slide could not be configured");
	die("Current Slide could not be configured");
}

echo json_encode(array('status'=>'true'));
