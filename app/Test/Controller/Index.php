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
        Smvc_Debug::start('Test_Controller_Index::login');
        $model = new Test_Model_Test();
        $model->setData("mrk", 2);
        $rand = rand();
        Smvc_Debug::dump($rand);
        for ($i = 0; $i < $rand * 1000; $i++) {}
        $model->setData(array('trt'=> 4, 'mek'));
        $this->getView()->render();
        Smvc_Debug::finish('Test_Controller_Index::login');
    }
    
    public function object()
    {

    }
}