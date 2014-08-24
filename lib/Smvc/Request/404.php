<?php

class Smvc_Request_404 extends Smvc_Request
{   
    public function __construct() 
    {
        $this->_module = Smvc_App::getConfig("404", "module");
        $this->_controller = Smvc_App::getConfig("404", "controller");
        $this->_action = Smvc_App::getConfig("404", "action");
        $this->_params = array();
    }
}