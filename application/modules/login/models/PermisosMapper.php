<?php

class Login_Model_PermisosMapper
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
            $this->setDbTable('Login_Model_DbTable_Permisos');
        }
        return $this->_dbTable;
    }
    
    public function loadPermiso(Login_Model_Permisos $permisos)
    {
        $data = array('id'=>$permisos->getIdrole());
        
        $select = $this->getDbTable()
         				->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
         				->setIntegrityCheck(false)
						->joinLeft('roles','roles.id=permissions.id_role')
						->where('permissions.id_role=?', $data['id']);
						
    	$resultSet = $this->getDbTable()->fetchAll($select);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Login_Model_Permisos();
            $entry->setIdrole($row->id_role)
            	  ->setIdresource($row->id_resource)
            	  ->setPermission($row->permission);
            		
            $entries[] = $entry;
        }
        return $entries;					
    }
    
	public function listaRouter(Login_Model_Permisos $resource)
    {
         $data = array(	'id_role'=> $resource->getIdrole());
         $select = $this->getDbTable()
         				->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
         				->setIntegrityCheck(false)
						->joinLeft('resource','resource.id=permissions.id_resource')
						->where('permissions.id_role=?', $data['id_role']);
						if (0 == count($select)) 
						{
							return;
						}
		$resultSet = $this->getDbTable()->fetchAll($select);
		$entries   = array();
		foreach ($resultSet as $row) {
			 if($row->id!=6&&$row->id!=59&&$row->id!=60){
	        	$entry = new Login_Model_Recursos();
	            $entry->setId($row->id)	
	            	  ->setIdparent($row->id_parent)	 
	                  ->setNombre($row->nombre)	                  
	            	  ->setResource($row->resource);
	            $entries[] = $entry;
            }
        }
        return $entries;
		
    }
    
	public function viewBulid(Login_Model_Permisos $resource,$recurso)
    {
         $data = array('id_role'=> $resource->getIdrole(),'resource'=>$recurso);
         $permisos=array();
         $select = $this->getDbTable()
         				->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
         				->setIntegrityCheck(false)
						->joinLeft('resource','resource.id=permissions.id_resource')
						->where('permissions.id_role=?', $data['id_role'])
						->where('resource.resource=?', $data['resource']);
						if (0 == count($select)) 
						{
							return;
						}
		$resultSet = $this->getDbTable()->fetchAll($select);
		$entries   = array();
		foreach ($resultSet as $row) {
			$permisos=array(
								'id'=>$row->id,
								'idparent'=>$row->id_parent,
								'permiso'=>$row->permission,
								'nombre'=>$row->nombre,
								'recurso'=>$row->resource
								);
	        	
           
        }
        return $permisos;
		
    }

}

