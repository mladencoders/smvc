<?php

class Smvc_Dispatcher
{
    protected $_request;
    
    public function run()
    {
        $this->_request = new Smvc_Request(isset($_GET['path']) ? $_GET['path']: null);
        $this->_dispatch();
    }
        
    protected function _dispatch()
    {
        $controlerClass = 'Controller_' . ucfirst($this->_request->getController());
        
        if (@class_exists($controlerClass)) {          
            $controller = new $controlerClass($this->_request, new Smvc_Response());
            $controller->dispatch();
        } else {
            self::dispatchTo404();
        } 
    }
    
    public static function dispatchTo404()
    {
        $controller = new Controller_Error(new Smvc_Request_404(), new Smvc_Response_404());
        $controller->dispatch();
    }
}