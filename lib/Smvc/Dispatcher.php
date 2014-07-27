<?php

class Smvc_Dispatcher
{
    protected $_request;
    
    public function run()
    {
        
        $this->_request = new Smvc_Request($_GET['path']);
        $this->_dispatch();
    }
        
    protected function _dispatch()
    {
        $controlerClass = 'Controller_' . ucfirst($this->_request->getController());
        
        if (@class_exists($controlerClass)) {          
            $controller = new $controlerClass($this->_request);
        } else {
            self::dispatchTo404();
            return;
        }

        $view = new Smvc_View($this->_request);
        $controller->setView($view);
        $controller->dispatch();
    }
    
    public static function dispatchTo404()
    {
        $request = new Smvc_Request_404();
        $controller = new Controller_Error($request);
        $view = new Smvc_View($request);
        $controller->setView($view);
        $controller->dispatch();
    }
}