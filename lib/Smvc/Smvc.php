<?php
require_once "Smvc/Autoloader.php";

class Smvc
{   
    public function bootstrap()
    {   
        
        $autoloader = new Autoloader();
        $autoloader->init();
        
        $dispatcher = new Smvc_Dispatcher();        
        $dispatcher->run();
        
    }   
}
