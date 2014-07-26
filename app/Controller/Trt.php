<?php

class Controller_Trt extends Smvc_Controller
{
    public function prc()
    {
        $this->getView()->setData('prcime', $this->getParam('ime'));
        $this->getView()->setData('mail', $this->getParam('mrk'));
        $this->getView()->render();
    }
}