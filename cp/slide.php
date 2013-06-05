<?php

header('content-type: application/json; charset=utf-8');

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');


Slide::extractCurrentSlideId();
$json = array(	'presentationFilename' => Slide::$presentationFilename,
		'presentationSlideId'  => Slide::$presentationSlideId,
		'presentationBlockId'  => Slide::$presentationBlockId);
echo json_encode($json);
