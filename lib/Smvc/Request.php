<?php

class Smvc_Request
{
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_module;
    
    function __construct($rawRequest) 
    {
        $this->_parseUrl($rawRequest);
        $this->_params = new Smvc_Params($this->_params);
    }
    
    public function getController()
    {
        return $this->_controller;
    }

    public function setController($controller)
    {
        $this->_controller = $controller;
    }

    public function getAction()
    {
        return $this->_action;
    }

    public function setAction($action)
    {
        $this->_action = $action;
    }

    public function getModule()
    {
        return $this->_module;
    }

    public function setModule($module)
    {
        $this->_module = $module;
    }
    
    public function getParam($key)
    {
        if ($this->_params->getParam($key)) {
            return $this->_params->getParam($key);
        } else if (isset($_POST[$key])) {
            return $_POST[$key];
        } else {
            return null;
        }
    }
    
    public function getParams()
    {
        return $this->_params->getParams();
    }
    
    public function getPost()
    {
        return $_POST;
    }
    
    public function getUrl($url)
    {
        $url = explode("/", $url);
        if ($url[0] === "*") {
            $url[0] = $this->getModule();
        }
        
        if ($url[1] === "*") {
            $url[1] = $this->getController();
        }
        
        if ($url[2] === "*") {
            $url[2] = $this->getAction();
        }
        
        return Smvc_App::getBaseUrl() . DS . implode(DS, $url);
    }
    
    private function _parseUrl($rawRequest)
    {    
        $url = $this->_getCustomRoute($rawRequest);
        $url = explode(
            '/', 
            filter_var(
                rtrim($url ? $url : $rawRequest, '/'), 
                FILTER_SANITIZE_URL
            )
        );
        
        $this->setModule(isset($url[0])? strtolower($url[0]) : 'index');
        $this->setController(isset($url[1])? strtolower($url[1]) : 'index');
        $this->setAction(isset($url[2])? strtolower($url[2]) : 'index');
        $this->_params = isset($url[3])? array_slice($url,3) : array();
    }
    
    private function _getCustomRoute($request)
    {
        return Smvc_App::getRouteConfig($request);
    }
}