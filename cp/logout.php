<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');

$session->logout();
$user_ip = $_SERVER['REMOTE_ADDR'];
Log::log_action('Login', "{$user_ip} is logged out");
redirect_to('index.php');
