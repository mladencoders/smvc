<?php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/app'));

// Define alias for DIRECTORY_SEPARATOR
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
  
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../lib'),
    get_include_path(),
)));

// Ensure app/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../app'),
    get_include_path(),
)));

// Ensure skin/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../skin'),
    get_include_path(),
)));

require_once 'Smvc/Smvc.php';

$app = new Smvc();
$app->bootstrap(dirname(__FILE__), 
    APPLICATION_PATH . DS . "config" . DS . "app.ini");
