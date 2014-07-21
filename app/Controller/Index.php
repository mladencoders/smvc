<?php

class Index extends Smvc_Controller
{
    public function index()
    {
        $this->_view->setData("message", "message");
        $this->_view->render();
    }
    
    public function login()
    {
        $this->_view->render();
    }
}