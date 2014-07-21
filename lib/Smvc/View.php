<?php

class Smvc_View
{
    protected $_template = "";
    protected $_isRendered = false;
    
    protected $_theame = "default";
    protected $_scripts = "";
    protected $_header = "";
    protected $_content = "";
    protected $_footer = "";
    
    protected $_data = array();
    
    function __construct() 
    {

    }
    
    public function setTemplate($template)
    {
        $this->_template = $template;
    }
    
    public function getTemplate()
    {
        return $this->_template;
    }
    
    public function renderTemplate()
    {
        $this->load();
        $this->render();  
    }
    
    public function load()
    {       
        $this->loadScripts();
        $this->loadHeader();
        $this->loadContent();
        $this->loadFooter();
    }
    
    public function render()
    {       
        echo '<html>';
        echo '<head>';
        echo $this->getScripts();
        echo '</head>';
        echo '<body>';
        echo $this->getHeader();
        echo $this->getContent();
        echo $this->getFooter();
        echo '</body>';
        echo '</html>';
    }
    
    public function loadScripts()
    {
        ob_start();
        require 'skin/' . $this->_theame . "/scripts.phtml";
        $this->_scripts = ob_get_clean();
    }
    
    public function loadHeader()
    {
        ob_start();
        require 'skin/' . $this->_theame . "/header.phtml";
        $this->_header = ob_get_clean();
    }
    
    public function loadContent()
    {
        ob_start();
        require 'View/' . $this->_template . ".phtml";
        $this->_content = ob_get_clean();
    }
    
    public function loadFooter()
    {
        ob_start();
        require 'skin/' . $this->_theame . "/footer.phtml";
        $this->_footer = ob_get_clean();
    }
    
    public function getScripts()
    {
        return $this->_scripts;
    }
    
    public function getHeader()
    {
        return $this->_header;
    }
    
    public function getContent()
    {
        return $this->_content;
    }
    
    public function getFooter()
    {
        return $this->_footer;
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