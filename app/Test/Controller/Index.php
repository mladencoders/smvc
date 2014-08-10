<?php

class Test_Controller_Index extends Smvc_Controller
{      
    public function index()
    {
        $session = new Smvc_Session();
        $session->start();
        $name = $session->getData("auth");
        Smvc::getConfig("database", "host");
        
        $this->getView()->render();
    }
    
    public function login()
    {
        $model = new Test_Model_Test2("auth", "account");
        Smvc_Debug::dump($model->SelectAll());
        $this->getView()->render();
    }
}