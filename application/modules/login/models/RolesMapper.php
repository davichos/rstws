<?php

class Login_Model_RolesMapper
{
	protected $_dbTable;
	protected $_lastInsertId;
	
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Login_Model_DbTable_Roles');
        }
        return $this->_dbTable;
    }
    
    public function rolesParent()
    {
        $select = $this->getDbTable()
         				->select();
    	
    	
    	$resultSet = $this->getDbTable()->fetchAll($select);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Login_Model_Roles();
            $entry->setId($row->id)
            	->setIdparent($row->id_parent);
            $entries[] = $entry;
        }
        return $entries;
    }

}

