<?php

class Smvc_Request extends Smvc_Object
{
    protected $_module          = 'index';
    protected $_controller      = 'index';
    protected $_action          = 'index';
    
    protected $_params;
    
    const URL_PART_ROUTE          = 0;
    const URL_PART_PARAMS         = 1;
    
    const ROUTE_PART_MODULE       = 0;
    const ROUTE_PART_CONTROLLER   = 1;
    const ROUTE_PART_ACTION       = 2;
    
    function __construct($rawRequest) 
    {
        $this->_parseUrl($rawRequest);
    }
    
    public function getController()
    {
        return $this->_controller;
    }

    public function setController($controller)
    {
        $this->_controller = $controller;
        
        return $this;
    }

    public function getAction()
    {
        return $this->_action;
    }

    public function setAction($action)
    {
        $this->_action = $action;
        
        return $this;
    }

    public function getModule()
    {
        return $this->_module;
    }

    public function setModule($module)
    {
        $this->_module = $module;
        
        return $this;
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
        foreach ($url as $index => &$value) {
            if ($value === '*') {
                $value = $this->_getRouteDataByIndex($index);
            }
        }
        
        return Smvc_App::getBaseUrl() . implode("/", $url);
    }
    
    protected function _parseUrl($rawRequest)
    {    
        Smvc_Debug::assert(is_string($rawRequest));
        
        $url = explode(
            '!', 
            filter_var(
                rtrim($rawRequest, '/'), 
                FILTER_SANITIZE_URL
            )
        );
        
        $this->_parseRoute($url[self::URL_PART_ROUTE]);                    
        $this->_params = new Smvc_Params(
            array_key_exists(self::URL_PART_PARAMS, $url)? 
            $url[self::URL_PART_PARAMS] : 
            ""
        );
        
        return $this;
    }
    
    protected function _parseRoute($route)
    {
        $croute = $this->_getCustomRoute($route);
        foreach (explode("/", trim($croute? $croute : $route, "/")) as $index => $value) {
            if (!empty($value)) {
                $this->_setRouteDataByIndex($index, $value);
            }
        }
        
        return $this;
    }
    
    protected function _getCustomRoute($request)
    {
        return Smvc_App::getRouteConfig($request);
    }
    
    protected function _getRouteDataByIndex($index) {
        switch($index) {
            case self::ROUTE_PART_MODULE: return $this->getModule(); break;
            case self::ROUTE_PART_CONTROLLER: return $this->getController(); break;
            case self::ROUTE_PART_ACTION: return $this->getAction(); break;
            default: return $this->getModule(); break;
        }
    }
    
    protected function _setRouteDataByIndex($index, $value) {
        switch($index) {
            case self::ROUTE_PART_MODULE: $this->setModule($value); break;
            case self::ROUTE_PART_CONTROLLER: $this->setController($value); break;
            case self::ROUTE_PART_ACTION: $this->setAction($value); break;
            default: break;
        }
        
        return $this;
    }
}