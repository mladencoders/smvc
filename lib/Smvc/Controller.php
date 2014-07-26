<?php

class Smvc_Controller
{
    protected $_view;
    protected $_request;
    
    function __construct(Smvc_Request $request) 
    {
        $this->_request = $request;
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
            $this->$action();
        }
        else {
            Smvc_Dispatcher::dispatchTo404();
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
}