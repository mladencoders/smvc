<?php

class Smvc_Config
{
    protected $_path
    protected $_config;
    public _construct($iniPath)
    {
        $config = parse_ini_file($iniPath);
    }
}