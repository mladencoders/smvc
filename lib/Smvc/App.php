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
        $this->_userBoootstrap();        

        return $this;
    }
    
    public function run()
    {   
        $dispatcher = new Smvc_Dispatcher();
        try {  
            $dispatcher->dispatch();
        } catch(Smvc_Dispatcher_Exception $e) {
            $dispatcher->dispatchTo404();
        }
        
        Smvc_Event_Manager::trigger("application_run_after");
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
        return self::getRootDirPath() . DS . $dir;
    }
    
    public static function getBaseUrl($dir = "")
    {
        return trim(self::getConfig("url", "base"), '/') . '/' . $dir;
    }
    
    public static function getConfig($section, $config)
    {
        //Smvc_Debug::start("Smvc_App::getConfig('{$section}', '{$config}}')");
        $configs = parse_ini_file(self::_getConfigPath("app.ini"), true);
        $appConfig = isset($configs[$section][$config]) ? $configs[$section][$config] : null;
        //Smvc_Debug::finish("Smvc_App::getConfig('{$section}', '{$config}}')");
        
        return $appConfig;
    }
    
    public static function getModuleConfig($module, $config)
    {
        Smvc_Debug::start("Smvc_App::getModuleConfig('{$module}', '{$config}')");
        $configs = parse_ini_file(self::_getConfigPath("modules.ini"), true);
        $moduleConfig = isset($configs[$module][$config]) ? $configs[$module][$config] : null;
        Smvc_Debug::finish("Smvc_App::getModuleConfig('{$module}', '{$config}')");
        
        return $moduleConfig;
    }
    
    public static function getRouteConfig($route)
    {
        Smvc_Debug::start("Smvc_App::getRouteConfig('{$route}')");
        $configs = parse_ini_file(self::_getConfigPath("routes.ini"), true);
        $routeConfig = isset($configs["custom_routes"][$route]) ? $configs["custom_routes"][$route] : null;
        Smvc_Debug::finish("Smvc_App::getRouteConfig('{$route}')");
        
        return $routeConfig;
    }
    
    public static function isModuleEnabled($module)
    {
        Smvc_Debug::start("Smvc_App::isModeuleEnabled('{$module}')");
        $configs = parse_ini_file(self::_getConfigPath("modules.ini"), true);
        $enabled = array_key_exists($module, $configs) && $configs[$module]["enabled"];
        Smvc_Debug::finish("Smvc_App::isModeuleEnabled('{$module}')");
        
        return $enabled;
    }
    
    protected function _userBoootstrap()
    {
        $configs = parse_ini_file(self::_getConfigPath("modules.ini"), true);
        foreach ($configs as $config) {
            if (!array_key_exists('bootstrap_class', $config)) {
                continue;
            }
            
            Smvc_Debug::start("{$config['bootstrap_class']}::bootstrap()");
            $config['bootstrap_class']::bootstrap();
            Smvc_Debug::finish("{$config['bootstrap_class']}::bootstrap()");
        }
    }
}
