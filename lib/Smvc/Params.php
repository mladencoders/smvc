<?php

class Smvc_Params
{
    protected $_params = array();
    
    function __construct(array $rawParams) 
    {
        $this->_params = $this->_parseParams($rawParams);
    }
    
    public function getParams()
    {
        return $this->_params;
    }
    
    public function getParam(string $key)
    {
        return isset($this->_params[$key])? $this->_params[$key] : null;
    }
    
    public function _parseParams(array $rawParams)
    {
        $params = array();
        for ($i = 1; $i < count($rawParams); $i += 2) {
            $params[$rawParams[$i - 1]] = $rawParams[$i];
        }
        
        return $params;
    }
}