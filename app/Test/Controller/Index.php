<?php

class Test_Controller_Index extends Smvc_Controller
{      
    public function index()
    {
        $this->getView()->setData("title", $this->getRequest()->getParam("test"));
        $this->getView()->render();
    }
    
    public function login()
    {
        $model = new Test_Model_Test2("auth", "account");
        Smvc_Debug::dump($model->SelectAll());
        $this->getView()->render();
    }
}