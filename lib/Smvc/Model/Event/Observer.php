<?php

abstract class Smvc_Model_Event_Observer
{
    protected $_event;
    
    public function __construct($event = "event_any") 
    {
        Smvc_Debug::assert(is_string($event));
        $this->setEvent($event);
    }
    
    public function getEvent()
    {
        return $this->_event;
    }

    public function setEvent($event)
    {
        Smvc_Debug::assert(is_string($event));
        $this->_event = $event;
    }
    
    public abstract function trigger($event);
}