<?php
require_once "Smvc/Autoloader.php";

class Smvc
{   
    private static $_root;
    private static $_paths = array();
    
    public function bootstrap()
    {   
        $autoloader = new Autoloader();
        $autoloader->init();
        
        $dispatcher = new Smvc_Dispatcher();        
        $dispatcher->run();  
    }

    public static function setRoot($root)
    {
        self::$_root = $root;
        self::$_paths['app'] = self::getRootDirPath() . DS . "app";
        self::$_paths['config'] = self::getRootDirPath() . DS . "config";
        self::$_paths['skin'] = self::getRootDirPath() . DS . "skin";
        self::$_paths['lib'] = self::getRootDirPath() . DS . "lib";
    }
    
    public static function getRootDirPath()
    {
        return self::$_root;
    }
    
    public static function getDirPath($dir)
    {
        return self::$_paths[$dir];
    }
}
