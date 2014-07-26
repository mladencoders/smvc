<?php

class Controller_Error extends Smvc_Controller
{
    public function index()
    {
        $this->getView()->render();
    }
}