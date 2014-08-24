<?php

class Smvc_Event_Manager
{
    protected static $_observers = array();
    
    public static function register(Smvc_Model_Event_Observer $observer)
    {
        self::$_observers[$observer->getEvent()][] = $observer;
    }
    
    public static function unregister(Smvc_Model_Event_Observer $observer)
    {
        if (!isset(self::$_observers[$observer->getEvent()])) {
            return;
        }
        
        foreach(self::$_observers[$observer->getEvent()] as $key => $registredObserver) {
            if ($observer === $registredObserver) {
                unset(self::$_observers[$observer->getEvent()][$key]);
            }
        }
    }
    
    public static function trigger($event, array $params = array())
    {      
        if (isset(self::$_observers[$event])) {
            foreach (self::$_observers[$event] as $observer) {
                $observer->trigger($params);
            }
        }
              
        if ("event_any" !== $event && isset(self::$_observers["event_any"])) {
            foreach (self::$_observers["event_any"] as $observer) {
                $observer->trigger($params);
            }
        }  
    }
}