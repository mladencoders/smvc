<?php

class Smvc_Model_Db_Table extends Smvc_Model_Db
{
    protected $_table;
    
    public function __construct($dbName, $tableName)
    {
        parent::__construct($dbName);
        
        $this->_table = $tableName;
    }
    
    public function selectAll()
    {
        return $this->select("*")
            ->from($this->_table)
            ->prepare()
            ->exec()
            ->fetchAll();
    }
}