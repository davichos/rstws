<?php

class Login_Model_UsuariosMapper {

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
            $this->setDbTable('Login_Model_DbTable_Usuarios');
        }
        return $this->_dbTable;
    }

    public function findAuth(Login_Model_Usuarios $usuarios) {
        $entrie = null;
        $data = array('username' => $usuarios->getUsername());
        $select = $this->getDbTable()
                ->select()
                ->where(' username= ?', $data['username']);

        $row = $this->getDbTable()->fetchRow($select);
        if ($row !== null) {
            $entries = array(
                'id' => $row->id,
                'name' => $row->nombre.' '.$row->ap_pat.' '.$row->ap_mat,
                'username' => $row->username,
                'email' => $row->email,
                'password' => $row->password,
                'block' => $row->block,
                'gid' => $row->gid
            );
            $ent = new Login_Model_Usuarios($entries);
            $entrie = array(
                'id' => $ent->getId(),
                'name' => $ent->getName(),
                'username' => $ent->getUsername(),
                'email' => $ent->getEmail(),
                'passwordcrypt' => $ent->getPassword(),
                'block' => $ent->getBlock(),
                'gid' => $ent->getGid()
            );
        }


        return $entrie;
    }

}

