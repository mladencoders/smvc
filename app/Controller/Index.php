<?php

class Controller_Index extends Smvc_Controller
{      
    public function index()
    {
        if ($this->getRequest()->getParam('name')) {
            $this->getView()->setData("name", $this->getRequest()->getParam('name'));
            $this->getView()->setData("title", $this->getRequest()->getParam('title'));
        }
        
        $this->getView()->render();
    }
    
    public function login()
    {
        $this->getView()->render();
    }
}