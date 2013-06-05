<?php

class User
{

	private static $passwordFile = PASSWORD_FILE;
	private static $password;

	public static function authenticate($password=""){
		self::getPassword();
		if(crypt($password, self::$password) == self::$password){
			return true;
		}else{
			return false;
		}
	}
	
	private function getPassword(){
		if(self::passwordFileExists()){
			if(is_readable(self::$passwordFile)){
				if(self::$password = file_get_contents(self::$passwordFile)){
				}else{
					Log::log_action('Passowrd', 'could not be read');
					die('Passowrd could not be read');
				}
			}else{
				Log::log_action('Passowrd', 'file is not readable');
				die('Passowrd file is not readable');
			}
		}
	}
	
	private function passwordFileExists(){
		if(file_exists(self::$passwordFile)){
			return true;
		}else{
			Log::log_action('Passowrd', 'file missing');
			die('Passowrd file missing');
			return false;
		}
	}
	
	public static function changePassword($password){
		$password = crypt($password);
		if(self::passwordFileExists()){
			if(is_writable(self::$passwordFile)){
				if(file_put_contents(self::$passwordFile, $password)){
					return true;
				}else{
					Log::log_action('Passowrd', 'could not be written');
					die('Passowrd could not be written');
					return false;
				}
			}else{
				Log::log_action('Passowrd', 'file is not writeable');
				die('Passowrd file is not writable');
				return false;
			}
		}
	}
}


