<?php

/**
 * Define the core paths
 * Loads necessary php files to initialize presentation2.0 (APP) app
 */

error_reporting(E_ALL);


/**
 * DIRECTORY_SEPERATOR is a PHP pre defined constant
 * \ for Windows and / for UNIX a like systems
 */
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);


/**
 * LIB directory for loading essential php files
 */
defined('LIB_PATH') ? null : define('LIB_PATH', __DIR__);

/**
 * Control Pannel directory
 */
defined('CP_PATH') ? null : define('CP_PATH', dirname(LIB_PATH));


/**
 * Root directory of Presentation2.0 
 */
defined('APP_ROOT') ? null : define('APP_ROOT', dirname(dirname(LIB_PATH)));


/**
 * Presentations directory, contains essentials presentations files and images
 */
defined('PRESENTATION_PATH') ? null : define('PRESENTATION_PATH', APP_ROOT.DS.'presentations');
defined('PRESENTATION_IMAGES') ? null : define('PRESENTATION_IMAGES', PRESENTATION_PATH.DS.'images');


/**
 * Load basic functions
 */
require_once(LIB_PATH.DS.'functions.inc.php');


/**
 * Load core classses
 */
require_once(LIB_PATH.DS.'user.class.php');
require_once(LIB_PATH.DS.'session.class.php');
require_once(LIB_PATH.DS.'log.class.php');
require_once(LIB_PATH.DS.'slide.class.php');
require_once(LIB_PATH.DS.'parser.class.php');


/**
 * Load external library
 */
require_once(LIB_PATH.DS.'HTMLPurifier.standalone.php');
require_once(LIB_PATH.DS.'Mustache'.DS.'Autoloader.php');
Mustache_Autoloader::register();
$Mustache = new Mustache_Engine;


/**
 * Auotload class files
 */
spl_autoload_register('class_autoloader');


/**
 * Log directory of site
 * log.txt file in log folder
 */
defined('LOG_PATH') ? null : define('LOG_PATH', CP_PATH.DS.'logs');
defined('LOG_FILE') ? null : define('LOG_FILE', LOG_PATH.DS.'log.txt');


/**
 * Templates
 */
require_once(LIB_PATH.DS.'cp.tpl.php');


/**
 * Passoword file
 */
defined('PASSWORD_FILE') ? null : define('PASSWORD_FILE', CP_PATH.DS.'config'.DS.'password');
defined('CURRENT_SLIDE_FILE') ? null : define('CURRENT_SLIDE_FILE', CP_PATH.DS.'config'.DS.'current_slide');

