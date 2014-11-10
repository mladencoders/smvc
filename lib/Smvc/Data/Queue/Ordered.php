<?php

class Smvc_Data_Queue_Ordered extends Smvc_Data_Queue
{
    protected $_sortStatment;
    
    public function __construct($sortStatment)
    {
        Smvc_Debug::assert(is_callable($sortStatment));
        parent::__construct();
    }
    
    public function setSortStatment($sortStatment)
    {
        $this->_sortStatment = $sortStatment;
        
        return $this;
    }
    
    public function getSortStatment()
    {
        return $this->_sortStatment;
    }
    
    public function add($value)
    {
        array_push($this->getQueue(), $value);
        usort($this->getQueue(), $this->getSortStatment());
        
        return $this;
    }
}