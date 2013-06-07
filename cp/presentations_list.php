<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');
require_once(LIB_PATH.DS.'authenticate.inc.php');


$body='';
$dh = opendir(PRESENTATION_PATH);
$file_ignored = false;

$body = '<div id="supports">MIME type supported:<em>text/plain</em>; charset=<em>us-ascii</em> and <em>text/plain</em>; charset=<em>utf-8</em></div>';
$body.='<br>List of slides files';

if($dh){
	while (false !== ($filename = readdir($dh))) {
		if((preg_match('/^[a-zA-Z0-9_]*.txt$/',$filename) ==true) ){
			$file_info = new finfo(FILEINFO_MIME);
			$mime_type = $file_info->buffer(file_get_contents(PRESENTATION_PATH.DS.$filename));
			if(($mime_type=='text/plain; charset=us-ascii') ||($mime_type=='text/plain; charset=utf-8')){
				$body.= "<li><a href=\"init_presentation.php?file={$filename}&slide=0&block=-1\">{$filename}</a></li>";
			}
		}
	}
}else{
	Log::log_action('Presentations', 'Directory could not be accessed');
	die('Presentations Directory could not be accessed');
}

// List of slide files
// MIME type supported 
//text/plain; charset=us-ascii
// text/plain; charset=utf-8


$values = array();
$values['includes']='';
$values['header'] = 'Presentation 2.O';
$values['body'] = $body;
$values['footer'] = '| <a href="presentation.php">Resume</a> | <a href="change_password.php">Change Passoword</a> | <a href="logout.php">Logout</a>';
echo $Mustache->render($cp_page_template, $values); 
