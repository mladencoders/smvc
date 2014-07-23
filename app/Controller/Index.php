<?php

class Controller_Index extends Smvc_Controller
{   
    function __construct() 
    {

    }
    
    public function index()
    {
        $this->getView()->setData("message", "message");
        $this->getView()->render();
    }
    
    public function login()
    {
        $this->getView()->render();
    }
}