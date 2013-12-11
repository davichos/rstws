<?php

class Login_Model_SessionsoapMapper
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
            $this->setDbTable('Login_Model_DbTable_Sessionsoap');
        }
        return $this->_dbTable;
    }

    public function save(Login_Model_Sessionsoap $session)
    { 
     $data = array(
     		'id'		=> $session->getId(),
            'id_session'=> $session->getIdsession(),
            'user' 		=> $session->getUser(),
            'pass' 		=> $session->getPass()
        );
        $select  = $this->getDbTable()
        				->select()
        				->where(' id= ?', $data['id']);
        				
 		$row = $this->getDbTable()->fetchRow($select); 
 		
        if (null === ($id = $row->id)) {
            $this->_lastInsertId = $this->getDbTable()->insert($data);
                        
        } else {
        		
        		$where  = $this->getDbTable()
        				->getAdapter()->quoteInto(' id= ?', $data['id']);
        		$this->getDbTable()->delete($where);
        	 	
        }
    }
    
    public function findsession(Login_Model_Sessionsoap $session)
    {
    	$entries = null;
    	$data = array('id'	=> $session->getId());
    	$select  = $this->getDbTable()
        				->select()
        				->where(' id= ?', $data['id']);	
    									
        $row = $this->getDbTable()->fetchRow($select);
       
            $entry = new Login_Model_Sessionsoap();
            $entry->setId($row->id)
            	->setIdsession($row->id_session)
            	->setUser($row->user)
            	->setPass($row->pass);
            $entries = array(
            	'id'=>$entry->getId(),
            	'idsession'=>$entry->getIdsession(),
            	'user'=>$entry->getUser(),
            	'pass'=>$entry->getPass(),
            );
       	$where  = $this->getDbTable()
        				->getAdapter()->quoteInto(' id= ?', $data['id']);
        		$this->getDbTable()->delete($where);
        
         return $entries;
    }
}

