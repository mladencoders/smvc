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
    
    public function get($block)
    {
        if (!isset($this->_blocks[$block])) {
            $this->_load($block);
        }
        
        return $this->_blocks[$block];
    }
    
    protected function _load($block)
    {
        ob_start();
        require 'skin/' . $this->_theme . "/" . $block . ".phtml";
        $this->_blocks[$block] = ob_get_clean();
    }
}