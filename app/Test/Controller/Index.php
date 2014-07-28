<?php

class Test_Controller_Index extends Smvc_Controller
{      
    public function index()
    {
        if ($this->getRequest()->getParam('name')) {
            $this->getView()->setData("name", $this->getRequest()->getParam('name'));
            $this->getView()->setData("title", $this->getRequest()->getParam('title'));
        }
        
        if ($this->getRequest()->getParam('dbname')) {
            $model = new Model_Test($this->getRequest()->getParam('dbname'));
            $this->getView()->setData("tables", $model->getTables());
        }
        
        $this->getView()->render();
    }
    
    public function login()
    {
        $this->getView()->render();
    }
}