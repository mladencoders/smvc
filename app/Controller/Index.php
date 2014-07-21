<?php

class Index extends Smvc_Controller
{   
    function __construct() 
    {

    }
    
    public function index()
    {
        $this->getView()->setData("message", "message");
        $this->getView()->renderTemplate();
    }
    
    public function login()
    {
        $this->getView()->renderTemplate();
    }
}