<?php

class Smvc_Request_404 extends Smvc_Request
{   
    function __construct() 
    {
        $this->_controller = Smvc::getConfig("404", "controller");
        $this->_action = Smvc::getConfig("404", "action");
        $this->_params = array();
    }
}