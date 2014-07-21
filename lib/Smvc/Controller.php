<?php

class Smvc_Controller
{
    protected $_view;
    protected $_params = array();
    
    function __construct() 
    {

    }
    
    public function setParams($params)
    {
        $this->_params = $params;
    }
    
    public function getParams()
    {
        return $this->_params;
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
}