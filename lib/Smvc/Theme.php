<?php

class Smvc_Theme
{
    protected $_theme;
    protected $_blocks = array();
    
    function __construct($themeName = "default") 
    {
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
    
    public function getBlock($block)
    {
        if (!isset($this->_blocks[$block])) {
            $this->_load($block, ".phtml");
        }
        
        return $this->_blocks[$block];
    }
    
    public function getCssBlock($block)
    {
        if (!isset($this->_blocks[$block])) {
            $this->_load($block, ".css");
        }
        
        return $this->_blocks[$block];
    }
    
    protected function _load($block, $extension)
    {
        ob_start();
        require 'skin' . DS . $this->_theme . DS . $block . $extension;
        $this->_blocks[$block] = ob_get_clean();
    }
}