<?php

class Smvc_Response extends Smvc_Object
{
    protected $_headers = array();
    protected $_body = "";
    protected $_status = 200;
    
    public function send()
    {
        $this->sendHeaders();
        $this->sendBody();
    }
    
    public function sendHeaders()
    {
        header('HTTP/1.1 ' . $this->_status);
        foreach ($this->_headers as $header) {
            header($header);
        }
    }
    public function setStatus($status)
    {
        $this->_status = $status;
    }
    
    public function addHeader($header)
    {
        $this->_headers[] = $header;
    }
    
    public function sendBody()
    {
        echo $this->_body;
    }
    
    public function setBody($body)
    {
        $this->_body = $body;
    }
    
    public function appendBody($output)
    {
        $this->_body .= $output;
    }
    
    public function prependBody($output)
    {
        $this->_body = $output . $this->_body;
    }
}