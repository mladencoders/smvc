<?php
require_once "Smvc/Autoloader.php";

class Smvc
{   
    private static $_root;
    private static $_url;
    private static $_paths = array();
    private static $_configPath;
    
    public function bootstrap($rootPath, $configPath)
    {   
        self::_setRoot($rootPath);
        self::_setConfigPath($configPath);
        
        $autoloader = new Autoloader();
        $autoloader->init();
        
        $dispatcher = new Smvc_Dispatcher();        
        $dispatcher->run();
    }

    private static function _setRoot($root)
    {   
        self::$_root = $root;
        self::$_paths['app'] = self::getRootDirPath() . DS . "app";
        self::$_paths['config'] = self::getRootDirPath() . DS . "config";
        self::$_paths['skin'] = self::getRootDirPath() . DS . "skin";
        self::$_paths['lib'] = self::getRootDirPath() . DS . "lib";
        self::$_paths[''] = self::getRootDirPath();
    }
    
    private static function _setConfigPath($path)
    {
        self::$_configPath = $path;
    }
    
    public static function getRootDirPath()
    {
        return self::$_root;
    }
    
    public static function getDirPath($dir)
    {
        return self::$_paths[$dir];
    }
    
    public static function getBaseUrl($dir = "")
    {
        return self::getConfig("url", "base") . $dir;
    }
    
    public static function getConfig($section, $config)
    {
        $configs = parse_ini_file(self::$_configPath, true);
        return isset($configs[$section][$config]) ? $configs[$section][$config] : null;
    }
    
    public static function dump($var, $echo = true)
    {
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        
        $header = "Smvc variable dump" . PHP_EOL; 
        $header .= "===============================" . PHP_EOL;
        $header .= "File: " . $caller['file'] . PHP_EOL;
        $header .= "Line: #" . $caller['line'] . PHP_EOL;
        $header .= "===============================";
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        $output .= "===============================";
        $output = '<pre>' . PHP_EOL . $header . PHP_EOL . $output . PHP_EOL . '</pre>';
        
        if ($echo) {
            echo $output;
        }
        
        return $output;
    }
}
