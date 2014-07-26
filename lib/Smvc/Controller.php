<?php

class Smvc_Controller
{
    protected $_view;
    protected $_params;
    
    function __construct(Smvc_Params $params) 
    {
        $this->_params = $params;
    }
    
    public function setView($view)
    {
        $this->_view = $view;
    }
    
    public function getView()
    {
        return $this->_view;
    }
    
    public function dispatch($action)
    {
        if (is_callable(array($this, $action))) {
            $this->$action();
        }
        else {
            throw new Exception("$action action not defined");
        }
    }
    
    public function getParams()
    {
        return $this->_params->getParams();
    }
    
    public function getParam(string $key)
    {
        return $this->_params->getParam($key);
    }
}