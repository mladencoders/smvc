<?php

class Smvc_Request
{
    protected $_controller;
    protected $_action;
    protected $_params;
    
    function __construct($rawRequest) 
    {
        $this->_parseUrl($rawRequest);
        $this->_params = new Smvc_Params($this->_params);
    }
    
    public function getController()
    {
        return $this->_controller;
    }
    
    public function getAction()
    {
        return $this->_action;
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
            $url[0] = $this->getController();
        }
        
        if ($url[1] === "*") {
            $url[1] = $this->getAction();
        }
        
        return Smvc::getBaseUrl() . "/" . implode("/", $url);
    }
    
    private function _parseUrl($rawRequest)
    {   
        $url = explode('/', 
            filter_var(rtrim($rawRequest, '/'), FILTER_SANITIZE_URL)
        );
        
        if (empty($rawRequest)) {
            $url = array();
        }
        
        $this->_controller = isset($url[0])? $url[0] : 'Index';
        $this->_action = isset($url[1])? $url[1] : 'index';
        $this->_params = isset($url[2])? array_slice($url,2) : array();
    }
}