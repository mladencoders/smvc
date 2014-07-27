<?php

class Smvc_View
{
    protected $_template;
    protected $_isRendered = false;
    protected $_layout;
    protected $_content;
    
    protected $_data = array();
    
    function __construct($template = "") 
    {
        $this->_layout = new Smvc_Layout();
        $this->_template = $template;
    }
    
    public function setTemplate($template)
    {
        $this->_template = $template;
    }
    
    public function getTemplate()
    {
        return $this->_template;
    }
    
    public function getLayout()
    {
        return $this->_layout;
    }
    
    public function render()
    {             
        $this->getLayout()->setContent($this->_getContent());
        $this->getLayout()->render();
    }
    
    protected function _loadContent()
    {
        ob_start();
        require 'View' . DS . $this->_template . ".phtml";
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
        return $this->_data[$key];
    }
}