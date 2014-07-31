<?php

class Smvc_Session
{
    protected $_running = false;
    
    public function start()
    {   
        $this->_running = true;
        return session_start();
    }
    
    public function stop()
    {   
        $this->_running = false;
        session_write_close();
    }
    
    public function destroy()
    {   
        $this->_running = false;
        return session_destroy();
    }
    
    public function isRunning()
    {
        return $this->_running;
    }
    
    public static function getSessionPath()
    {
        return session_save_path();
    }
    
    public static function setSessionPath($path)
    {   
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        
        return session_save_path($path);
    }
    
    public function setData($key, $value)
    {
        if (!$this->isRunning()) {
            return false;
        }
        
        $_SESSION[$key] = $value;
        return true;
    }
    
    public function getData($key)
    {
        if (!$this->isRunning()) {
            return null;
        }
        
        return isset($_SESSION[$key])? $_SESSION[$key] : null;
    }
}