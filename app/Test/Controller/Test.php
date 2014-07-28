<?php

class Test_Controller_Test extends Smvc_Controller
{
    public function index()
    {
        $this->getView()->render();
    }
}