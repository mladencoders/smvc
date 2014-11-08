<?php

class Smvc_Params
{
    protected $_params = array();
    
    function __construct($rawParams) 
    {
        $this->_params = $this->_parseParams($rawParams);
    }
    
    public function getParams()
    {
        return $this->_params;
    }
    
    public function getParam($key)
    {
        return isset($this->_params[$key])? $this->_params[$key] : null;
    }
    
    public function _parseParams($rawParams)
    {
        $rawParams = explode("/", $rawParams);
        $params = array();
        for ($i = 1; $i < count($rawParams); $i += 2) {
            $params[$rawParams[$i - 1]] = $rawParams[$i];
        }
        
        return $params;
    }
}