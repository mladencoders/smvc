<?php

class Smvc_Data_Queue extends Smvc_Object
{
    protected $_queue;
    
    public function __construct()
    {
        $this->_queue = array();
    }
    
    public function getQueue()
    {
        return $this->_queue;
    }
    
    public function add($value)
    {
        array_push($this->getQueue(), $value);
        
        return $this;
    }
    
    public function remove()
    {
        return array_shift($this->getQueue());
    }
      
    public function clear()
    {
        $this->_queue = array();
    }
}