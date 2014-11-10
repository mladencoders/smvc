<?php

class Smvc_Data_Queue_Ordered extends Smvc_Data_Queue
{
    protected $_sortStatment;
    protected $_isSorted;
    
    public function __construct($sortStatment)
    {
        parent::__construct();
        $this->setSortStatment($sortStatment);
    }
    
    public function setSortStatment($sortStatment)
    {
        Smvc_Debug::assert(is_callable($sortStatment));
        $this->_sortStatment = $sortStatment;
        
        return $this;
    }
    
    public function getSortStatment()
    {
        return $this->_sortStatment;
    }
    
    public function add($value)
    {
        array_push($this->_queue, $value);
        $this->_setIsSorted(false);
        
        return $this;
    }
    
    public function remove()
    {
        if (!$this->_isSorted()) {
            $this->_sort();
        }
        
        return array_shift($this->_queue);
    }
    
    protected function _setIsSorted($isSorted)
    {
        $this->_isSorted = $isSorted;
        
        return $this;
    }
    
    protected function _isSorted()
    {
        return $this->_isSorted;
    }
    
    protected function _sort() {
        usort($this->_queue, $this->getSortStatment());
        $this->_setIsSorted(true);
        
        return $this;
    }
}