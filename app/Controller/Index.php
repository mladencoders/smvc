<?php

class Controller_Index extends Smvc_Controller
{      
    public function index()
    {
        $this->getView()->setData("message", "message");
        Smvc::dump($this->getParams());
        $this->getView()->render();
    }
    
    public function login()
    {
        $this->getView()->render();
    }
}