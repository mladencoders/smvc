<?php
require_once "Smvc/Autoloader.php";

class Smvc_App
{   
    private static $_root;
    private static $_url;
    private static $_paths = array();
    private static $_configPath;
    
    public function bootstrap($rootPath, $configPath)
    {   
        ini_set('display_errors', 1); 
        error_reporting(E_ALL);
        
        self::_setRoot($rootPath);
        self::_setConfigPath($configPath);
        
        $autoloader = new Smvc_Autoloader();
        $autoloader->init();
        
        if ($sessionPath = self::getConfig("session", "path")) {
            Smvc_Session::setSessionPath(Smvc_App::getDirPath() 
                . DS 
                . $sessionPath
            );
        }
        
        // Run user bootstrap
        UserBootstrap::bootstrap();

        return $this;
    }
    
    public function run()
    {   
        Smvc_Event_Manager::trigger("application_run_started");
        $dispatcher = new Smvc_Dispatcher();
        
        try {  
            $dispatcher->dispatch();
        } catch(Smvc_Dispatcher_Exception $e) {
            $dispatcher->dispatchTo404();
        }
        
        Smvc_Event_Manager::trigger("application_run_completed");
        return $this;
    }
    
    private static function _setRoot($root)
    {   
        self::$_root = $root;
    }
    
    private static function _setConfigPath($path)
    {
        self::$_configPath = $path;
    }
    
    private static function _getConfigPath($configFile)
    {
        return self::$_configPath . $configFile;
    }
    
    public static function getRootDirPath()
    {
        return self::$_root;
    }
    
    public static function getDirPath($dir = "")
    {
        return self::getRootDirPath() . $dir;
    }
    
    public static function getBaseUrl($dir = "")
    {
        return self::getConfig("url", "base") . $dir;
    }
    
    public static function getConfig($section, $config)
    {
        $configs = parse_ini_file(self::_getConfigPath("app.ini"), true);
        return isset($configs[$section][$config]) ? $configs[$section][$config] : null;
    }
    
    public static function getModuleConfig($module, $config)
    {
        $configs = parse_ini_file(self::_getConfigPath("modules.ini"), true);
        return isset($configs[$module][$config]) ? $configs[$module][$config] : null;
    }
    
    public static function isModuleEnabled($module)
    {
        $configs = parse_ini_file(self::_getConfigPath("modules.ini"), true);
        return array_key_exists($module, $configs) && $configs[$module]["enabled"];
    }
}
