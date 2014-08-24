<?php
// Define alias for DIRECTORY_SEPARATOR
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . DS . 'app'));
  
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . DS . '..' .  DS . 'lib'),
    get_include_path(),
)));

// Ensure app/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH),
    get_include_path(),
)));

require_once 'Smvc/App.php';

$app = new Smvc_App();
$app->bootstrap(
    dirname(__FILE__), 
    APPLICATION_PATH . DS . "config" . DS . "app.ini"
)->run();