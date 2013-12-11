<?php

class Login_Model_RecursosMapper {

    protected $_dbTable;
    protected $_lastInsertId;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Login_Model_DbTable_Recursos');
        }
        return $this->_dbTable;
    }

    public function recursosParent() {
        //$data = array('id'=>$recusos->getId());
        $select = $this->getDbTable()
                ->select();

        $resultSet = $this->getDbTable()->fetchAll($select);
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Login_Model_Recursos();
            $entry->setId($row->id)
                    ->setIdparent($row->id_parent);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function findResource(Login_Model_Recursos $resource) {
        date_default_timezone_set('America/Mexico_City');
        $data = array('resource' => $resource->getResource());
        $select = $this->getDbTable()
                ->select()
                ->where('resource=?', $data['resource']);
        $resultSet = $this->getDbTable()->fetchRow($select);
        if (null !== $resultSet) {
            $resource->setId($resultSet->id);
            $entidades[] = $resource;
            return $entidades;
        }
        return array();
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            if ($row->id != 6) {
                $entry = new Login_Model_Recursos();
                $entry->setId($row->id)
                        ->setNombre($row->nombre);
                $entries[] = $entry;
            }
        }
        return $entries;
    }

    public function findModule($id, Login_Model_Recursos $resource) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $resource->setResource($row->resource);
        return $resource;
    }

}