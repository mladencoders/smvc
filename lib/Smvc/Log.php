<?php

class Smvc_Log
{
    public static function log($message, $logType = 'system-log')
    {
        self::logRaw(date(Smvc_App::getConfig($logType, "time_format")) . " - " . $message, $logType);
    }
    
    public static function logRaw($message, $logType = 'system-log')
    {
        if ((int)Smvc_App::getConfig($logType, "enabled") !== 1) {
            return;
        }
        
        $logPath = Smvc_App::getDirPath() . Smvc_App::getConfig($logType, "path");
        if (! file_exists(dirname($logPath))) {
            mkdir(dirname($logPath), 0777, true);
        }
        
        file_put_contents($logPath, $message.PHP_EOL, FILE_APPEND);
    }
}