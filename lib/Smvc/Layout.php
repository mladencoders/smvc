<?php

class Smvc_Layout
{
    protected $_theme;
    protected $layout;
    protected $content = "";
    protected $_blocks = array();
    
    function __construct($themeName = null) 
    {   
        if ($themeName === null) {
            $themeName = Smvc_App::getConfig("default", "theme");
        }
        
        $this->_theme = $themeName;
    }
    
    public function setTheme($themeName)
    {
        $this->_theme = $themeName;
    }
    
    public function getTheme()
    {
        return $this->_theme;
    }
    
    public function setContent($content)
    {
        $this->_content = $content;
    }
    
    public function getContent()
    {
        return $this->_content;
    }
    
    public function getBlock($block)
    {
        Smvc_Debug::start("Smvc_Layout::getBlock('{$block}}')");
        if (!isset($this->_blocks[$block])) {
            $this->_loadBlock($block, ".phtml");
        }
        
        Smvc_Debug::finish("Smvc_Layout::getBlock('{$block}}')");
        return $this->_blocks[$block];
    }  
    
    public function load()
    {
        Smvc_Debug::start("Smvc_Layout::load()");
        if (!isset($this->_layout)) {
            $this->_load();
        }
        Smvc_Debug::finish("Smvc_Layout::load()");
        
        return $this->_layout;
    }
    
    protected function _loadBlock($block, $extension)
    {
        ob_start();
        require 'theme' . DS . $this->getTheme() . DS . $block . $extension;
        $this->_blocks[$block] = ob_get_clean();
    }
    
    protected function _load()
    {
        ob_start();
        require 'theme' . DS . $this->getTheme() . DS . "layout.phtml";
        $this->_layout = ob_get_clean();
        
        return $this->_layout;
    }
}