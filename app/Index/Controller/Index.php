<?php

class Index_Controller_Index extends Smvc_Controller
{      
    public function index()
    {       
        $this->getView()->render();
    }
}