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
        $model = new Test_Model_Test();
        $model->setData("mrk", 2);
        $model->setData(array('trt'=> 4, 'mek'));
        Smvc_Debug::dump($model->getData());
        $this->getView()->render();
    }
    
    public function object()
    {

    }
}