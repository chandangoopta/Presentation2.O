<?php

header('content-type: application/json; charset=utf-8');

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require_once('includes'.DS.'init.inc.php');

Parser::parse();
echo Parser::$parseResult;
