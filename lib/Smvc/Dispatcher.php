<?php

class Smvc_Dispatcher
{
    protected $_request;
    protected $_response;
    
    public function getRequest()
    {
        return $this->_request;
    }

    public function setRequest($request)
    {
        $this->_request = $request;
    }

    public function getResponse()
    {
        return $this->_response;
    }

    public function setResponse($response)
    {
        $this->_response = $response;
    }
        
    public function dispatch()
    {
        $this->setRequest(new Smvc_Request(isset($_GET['path']) ? $_GET['path'] : null));
        $this->setResponse(new Smvc_Response());
        $this->_dispatch();
    }
    
    public function dispatchTo404()
    {
        $this->setRequest(new Smvc_Request_404());
        $this->setResponse(new Smvc_Response_404());
        $this->_dispatch();   
    }
    
    protected function _dispatch()
    {
        if (!Smvc_App::isModuleEnabled($this->getRequest()->getModule())) {
            throw new Smvc_Dispatcher_Exception("Module not enabled");
        }
        
        $controlerClass = $this->_getControllerClass($this->getRequest());
        
        if (@class_exists($controlerClass)) {          
            $controller = new $controlerClass($this->getRequest(), $this->getResponse());
            $controller->dispatch();
        } else {
            throw new Smvc_Dispatcher_Exception("Controller not found");
        }
        
        $this->getResponse()->send();
    }
    
    private function _getControllerClass(Smvc_Request $request)
    {
        return $controlerClass = ucfirst($this->getRequest()->getModule()) 
        . '_Controller_' 
        . ucfirst($this->_request->getController());
    }
}