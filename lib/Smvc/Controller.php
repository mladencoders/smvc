<?php

class Smvc_Controller
{
    protected $_view;
    protected $_request;
    protected $_response;
    
    function __construct(Smvc_Request $request, Smvc_Response $response) 
    {
        $this->_request = $request;
        $this->_response = $response;
        $this->setView(new Smvc_View($this->_request, $this->_response));
    }
    
    public function setView($view)
    {
        $this->_view = $view;
    }
    
    public function getView()
    {
        return $this->_view;
    }
    
    public function dispatch()
    {
        $action = $this->_request->getAction();
        if (is_callable(array($this, $action))) {
            Smvc_Event_Manager::trigger("controller_dispatch_before");
            $this->$action();
            Smvc_Event_Manager::trigger("controller_dispatch_after");
        }
        else {
            throw new Smvc_Dispatcher_Exception("Action not found");
        }
    }
    
    public function getParams()
    {
        return $this->_request->getParams();
    }
    
    public function getParam($key)
    {
        return $this->_request->getParam($key);
    }
    
    public function getRequest()
    {
        return $this->_request;
    }
}