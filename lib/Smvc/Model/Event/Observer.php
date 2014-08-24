<?php

abstract class Smvc_Model_Event_Observer
{
    protected $_event;
    
    public function __construct($event = "event_any") 
    {
        $this->setEvent($event);
    }
    
    public function getEvent()
    {
        return $this->_event;
    }

    public function setEvent($event)
    {
        $this->_event = $event;
    }
    
    public abstract function trigger($event);
}