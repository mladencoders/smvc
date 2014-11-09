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
        
        return $this;
    }

    public function getResponse()
    {
        return $this->_response;
    }

    public function setResponse($response)
    {
        $this->_response = $response;
        
        return $this;
    }
        
    public function dispatch()
    {
        Smvc_Debug::start("Smvc_Dispatcher::dispatch()");
        $this->setRequest(new Smvc_Request(isset($_GET['path']) ? $_GET['path'] : ""));
        $this->setResponse(new Smvc_Response());
        $this->_dispatch();
        $this->getResponse()->send();
        Smvc_Debug::finish("Smvc_Dispatcher::dispatch()");
        
        return $this;
    }
    
    public function dispatchTo404()
    {
        $this->setRequest(new Smvc_Request_404());
        $this->setResponse(new Smvc_Response_404());
        $this->_dispatch();   
        $this->getResponse()->send();
        
        return $this;
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

        return $this;
    }
    
    private function _getControllerClass(Smvc_Request $request)
    {
        return $controlerClass = ucfirst($this->getRequest()->getModule()) 
        . '_Controller_' 
        . ucfirst($this->_request->getController());
    }
}