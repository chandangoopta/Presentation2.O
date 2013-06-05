<?php

require_once(LIB_PATH.DS.'functions.inc.php');

class Log
{
	
	static private $log_path = LOG_PATH;
	static private $log_file = LOG_FILE;
	static private $new_log_file; 

	static public function log_action($action, $message=""){
		if(self::log_directory()){
			if($handle = fopen(self::$log_file, 'a')){
				$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
				$content = "{$timestamp} | {$action}: {$message}\n";
				fwrite($handle, $content);
				fclose($handle);
			}else{
				die('Could not open <em><b>presentation2.0/cp/logs/log.txt</b></em> file for writing');
			}
		}
	}
	
	private function log_directory(){
		if(!file_exists(self::$log_path)){
			die('Create a <em><b>logs</b></em> directory here <em><b>presentation2.0/cp/</b></em>');
			return false;
		}
		if(!is_writable(self::$log_path)){
			die('Give write permission to <em><b>presentation2.0/cp/logs/</b></em>');
			return false;
		}
		return true;
	}
}



