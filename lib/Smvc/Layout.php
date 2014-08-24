<?php

class Smvc_Layout
{
    protected $_skin;
    protected $layout;
    protected $content = "";
    protected $_blocks = array();
    
    function __construct($skinName = null) 
    {   
        if ($skinName === null) {
            $skinName = Smvc_App::getConfig("skin", "name");
        }
        
        $this->_skin = $skinName !== null ? $skinName : "default";
    }
    
    public function setSkin($skinName)
    {
        $this->_skin = $skinName;
    }
    
    public function getSkin()
    {
        return $this->_skin;
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
        if (!isset($this->_blocks[$block])) {
            $this->_loadBlock($block, ".phtml");
        }
        
        return $this->_blocks[$block];
    }  
    
    public function load()
    {
        if (!isset($this->_layout)) {
            $this->_load();
        }
        
        return $this->_layout;
    }
    
    protected function _loadBlock($block, $extension)
    {
        ob_start();
        require 'skin' . DS . $this->_skin . DS . $block . $extension;
        $this->_blocks[$block] = ob_get_clean();
    }
    
    protected function _load()
    {
        ob_start();
        require 'skin' . DS . $this->_skin . DS . "layout.phtml";
        $this->_layout = ob_get_clean();
        
        return $this->_layout;
    }
}