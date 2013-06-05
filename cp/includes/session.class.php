<?php

class Session
{
	private $logged_in = false;
	public $user_ip;

	function __construct(){
		session_start();
		$this->check_login();
	}

	function check_login(){
		if(isset($_SESSION['user_ip'])){
			$this->user_ip = $_SESSION['user_ip'];
			$this->logged_in = true;
		}else{
			unset($this->user_ip);
			$this->logged_in = false;
		}
	}

	public function is_logged_in(){
		return $this->logged_in;
	}

	public function login($user){
		if($user){
			$this->user_ip = $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
			$this->logged_in = true;
		}
	}	

	public function logout(){
		unset($_SESSION['user_ip']);
		unset($this->user_ip);
		$this->logged_in = false;
	}

}

$session = new Session();
