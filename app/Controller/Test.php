<?php

class Controller_Test extends Smvc_Controller
{
    public function index()
    {
        $this->getView()->render();
    }
}