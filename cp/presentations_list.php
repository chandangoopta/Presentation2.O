<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');
require_once(LIB_PATH.DS.'authenticate.inc.php');


$body='';
$dh = opendir(PRESENTATION_PATH);
$file_ignored = false;
if($dh){
	while (false !== ($filename = readdir($dh))) {
		if((preg_match('/^[a-zA-Z0-9_]*.txt$/',$filename) ==true) ){
			$file_info = new finfo(FILEINFO_MIME);
			$mime_type = $file_info->buffer(file_get_contents(PRESENTATION_PATH.DS.$filename));
			if(($mime_type=='text/plain; charset=us-ascii') ||($mime_type=='text/plain; charset=utf-8')){
				$body.= "<a href=\"init_presentation.php?file={$filename}&slide=0&block=-1\">{$filename}<a/><br/>";
			}
		}
	}
}else{
	Log::log_action('Presentations', 'Directory could not be accessed');
	die('Presentations Directory could not be accessed');
}


$values = array();
$values['includes']='';
$values['body'] = $body;
$values['footer'] = '<a href="logout.php">Logout</a> | <a href="change_password.php">Change Passoword</a>';
echo $Mustache->render($cp_page_template, $values); 
