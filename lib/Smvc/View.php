<?php

class Smvc_View
{
    protected $_template;
    protected $_isRendered = false;
    
    protected $_content;
    
    protected $_data = array();
    
    function __construct($template = "") 
    {
        $this->_theame = new Smvc_Theme();
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
    
    public function getTheme()
    {
        return $this->_theame;
    }
    
    public function render()
    {             
        echo $this->_getContent();
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