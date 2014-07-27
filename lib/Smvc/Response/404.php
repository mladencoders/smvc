<?php

class Smvc_Response_404 extends Smvc_Response
{   
    public function __construct() 
    {
        $this->setStatus(404);
    }
}