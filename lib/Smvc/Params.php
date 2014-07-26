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
    
    public function getPost()
    {
        return $this->_params;
    }
    
    public function getParam($key, $inPost = false)
    {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        } else if ($inPost && isset($_POST[$key])) {
            return $_POST[$key];
        } else {
            return null;
        }
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