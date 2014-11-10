<?php

class Smvc_Data_Stack extends Smvc_Object
{   
    protected $_stack;

    public function __construct()
    {
        $this->_stack = array();
    }
    
    public function push($value)
    {
        array_push($this->_stack, $value);
    }
    
    public function pop()
    {
        return array_pop($this->_stack); 
    }
    
    public function clear()
    {
        $this->_stack = array();
    }
}