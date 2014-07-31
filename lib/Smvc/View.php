<?php

class Smvc_View
{
    protected $_template;
    protected $_isRendered = false;
    protected $_layout;
    protected $_content;
    protected $_request;
    protected $_response;
    
    protected $_data = array();
    
    function __construct(Smvc_Request $request, Smvc_Response $response) 
    {        
        $this->_request = $request;
        $this->_response = $response;
        $this->_template = $this->getRequest()->getController() . DS . $this->getRequest()->getAction();
        $this->_layout = new Smvc_Layout(
            Smvc::getModuleConfig($this->getRequest()->getModule(), "skin", "name")
        );
    }
    
    public function setTemplate($template)
    {
        $this->_template = $template;
    }
    
    public function getTemplate()
    {
        return $this->_template;
    }
    
    public function getRequest()
    {
        return $this->_request;
    }
    
    public function getLayout()
    {
        return $this->_layout;
    }
    
    public function render()
    {             
        $this->getLayout()->setContent($this->_getContent());
        $this->_response->setBody($this->getLayout()->load());
    }
    
    protected function _loadContent()
    {
        ob_start();
        require $this->getRequest()->getModule() . DS . 'View' . DS . $this->getTemplate() . ".phtml";
        $this->_content = ob_get_clean();
    }
    
    protected function _getContent()
    {
        if (!isset($this->_content)) {
            $this->_loadContent();
        }
        
        return $this->_content;
    }
    
    public function setData($key, $value)
    {
        $this->_data[$key] = $value;
    }
    
    public function getData($key)
    {
        return isset($this->_data[$key])? $this->_data[$key]: null;
    }
}