<?php

class Smvc_Debug
{
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
}