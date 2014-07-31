<?php

class Smvc_Dispatcher
{
    protected $_request;
    protected $_response;
    
    public function run()
    {
        $this->_request = new Smvc_Request(isset($_GET['path']) ? $_GET['path']: null);
        $this->_response = new Smvc_Response();
        $this->_dispatch();
    }
        
    protected function _dispatch()
    {
        $controlerClass = ucfirst($this->_request->getModule()) . '_Controller_' . ucfirst($this->_request->getController());
        
        if (@class_exists($controlerClass)) {          
            $controller = new $controlerClass($this->_request, $this->_response);
            $controller->dispatch();
        } else {
            self::dispatchTo404();
        }
        
        $this->_response->send();
    }
    
    public static function dispatchTo404()
    {
        $controller = new Index_Controller_Error(new Smvc_Request_404(), new Smvc_Response_404());
        $controller->dispatch();
    }
}