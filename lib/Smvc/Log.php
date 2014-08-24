<?php

class Smvc_Log
{
    protected $_path = "";
    protected $_enabled = 0;
    
    public function __construct($path)
    {      
        $this->_path = Smvc_App::getDirPath() . DS . ltrim("\\/", $path);
        if (! file_exists(dirname($logPath))) {
            mkdir(dirname($logPath), 0777, true);
        }
        
        file_put_contents($this->_path, "", FILE_APPEND);
    }
    
    public function userLog($message) 
    {
        file_put_contents(
            $this->_path,
            date(Smvc_App::getConfig("log", "time_format")) . 
            " - " . 
            $message . 
            PHP_EOL, 
            FILE_APPEND
        );
    }
    
    public static function log($message)
    {
        self::logRaw(date(Smvc_App::getConfig("log", "time_format")) . " - " . $message);
    }
    
    public static function logRaw($message)
    {
        if ((int)Smvc_App::getConfig("log", "enabled") !== 1) {
            return;
        }
        
        $logPath = Smvc_App::getDirPath() . Smvc_App::getConfig("log", "path");
        if (! file_exists(dirname($logPath))) {
            mkdir(dirname($logPath), 0777, true);
        }
        
        file_put_contents($logPath, $message.PHP_EOL, FILE_APPEND);
    }
    
    protected function _isEnabled()
    {
        if (!isset($this->_enabled)) {
            $this->_enabled = (int)Smvc_App::getConfig("log", "enabled") === 1;
        }
        
        return $this->_enabled;
    }
}