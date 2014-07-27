<?php

class Smvc_Log
{
    protected $_path;
    public function __construct($path)
    {      
        $this->_path = Smvc::getDirPath() . DS . ltrim("\\/", $path);
        if (! file_exists(dirname($logPath))) {
            mkdir(dirname($logPath), 0777, true);
        }
        
        file_put_contents($this->_path, "", FILE_APPEND);
    }
    
    public function userLog($message) 
    {
        file_put_contents(
            $this->_path,
            date(Smvc::getConfig("log", "time_format")) . 
            " - " . 
            $message . 
            PHP_EOL, 
            FILE_APPEND
        );
    }
    
    public static function log($message)
    {
        self::logRaw(date(Smvc::getConfig("log", "time_format")) . " - " . $message);
    }
    
    public static function logRaw($message)
    {
        if ((int)Smvc::getConfig("log", "enabled") !== 1) {
            return;
        }
        
        $logPath = Smvc::getDirPath() . Smvc::getConfig("log", "path");
        if (! file_exists(dirname($logPath))) {
            mkdir(dirname($logPath), 0777, true);
        }
        
        file_put_contents($logPath, $message.PHP_EOL, FILE_APPEND);
    }

}