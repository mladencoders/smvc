<?php

class Smvc_Dispatcher
{
    protected $_controller;
    protected $_action;
    protected $_params;
    
    public function run()
    {
        $this->_parseUrl();
        $this->_dispatch();
    }
    
    protected function _parseUrl()
    {
        if (isset($_GET['path'])) {
           $url = explode('/', filter_var(rtrim($_GET['path'], '/'), FILTER_SANITIZE_URL));
        }
        
        $this->controller = isset($url[0])? $url[0] : 'index';
        $this->action = isset($url[1])? $url[1] : 'index';
        $this->params = isset($url[2])? array_slice($url,2) : array();
    }
    
    protected function _dispatch()
    {
        require APPLICATION_PATH . '/Controller/' . $this->controller . ".php";
        $controller = new $this->controller;
        
        $view = new Smvc_View();
        $view->setTemplate($this->controller . '/' . $this->action);
        $controller->setView($view);
        $controller->dispatch($this->action);
    }
}