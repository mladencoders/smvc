<?php

class Smvc_Debug
{
    protected static $_timers = array();
 
    public static function dump($var, $echo = true)
    {
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        
        $header = "===============================" . PHP_EOL;
        $header .= "Smvc variable dump" . PHP_EOL; 
        $header .= "-------------------------------" . PHP_EOL;
        $header .= "File: " . $caller['file'] . PHP_EOL;
        $header .= "Line: #" . $caller['line'] . PHP_EOL;
        $header .= "-------------------------------";
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        $output .= "===============================" . PHP_EOL;
        $output = '<pre>' . PHP_EOL . $header . PHP_EOL . $output . PHP_EOL . '</pre>';
        
        
        if ($echo) {
            echo $output;
        }
        
        return $output;
    }
    
    public static function start($timerName)
    {
        self::$_timers[$timerName] = array(
            'timer'         => microtime(true),
            'timer_name'    => $timerName
        );
    }
    
    public static function finish($timerName)
    {
        $timer = self::cancel($timerName);
        Smvc_Log::log("{$timerName} needed {$timer['timer']}s to complete", 'debug-log');
        
        return $timer;
    }
    
    public static function cancel($timerName)
    {
        $timer = null;
        if (array_key_exists($timerName, self::$_timers)) {
            $timer = self::$_timers[$timerName];
            $timer['timer'] = microtime(true) - $timer['timer'];
            unset(self::$_timers[$timerName]);
        }
        
        return $timer;
    }
}