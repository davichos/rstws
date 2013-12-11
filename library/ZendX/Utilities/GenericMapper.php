<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AsignModel
 *
 * @author DGomez
 */
class ZendX_Utilities_GenericMapper extends ZendX_Utilities_Bd implements ZendX_Utilities_Interfaces_GenericOperations {

    public function findOne($id) {
        if (null === $id) {
            return null;
        }
        $select = $this->getBd()->getDbTable()
                ->select()
                ->where($this->_idKeyName . '=?', $id);
        return $this->getBd()->getDbTable()->fetchRow($select);
    }

    public function insert($data) {
        $data['fecha_creacion'] = $this->getTimestamp();
        $this->setLastInsertId($this->getBd()->getDbTable()->insert($data));
    }

    public function update($data, $idValue) {
        unset($data['fecha_creacion']);
        $data['fecha_actualizacion'] = $this->getTimestamp();
        return $this->getBd()->getDbTable()->update($data, array($this->_idKeyName . '=?' => $idValue));
    }

    public function findid($id, $keysubform) {
        $consulta = new ZendX_Utilities_Consulta($this->getBd());
        return $consulta->findId($id, $keysubform, $this->_idKeyName);
    }

    public function changeEstatus($array) {
        foreach ($array as $key => $value) {
            $result = $this->findOne($value);
            if (null !== $result) {
                $data = array('estatus' => ((int) $result->estatus) * -1);
                $array=$result->toArray();
                $this->update($data, $array[$this->_idKeyName]);
            }
        }
    }

    public function getTimestamp($date = null) {
        return ZendX_Utilities_Date::getCurrentTimestamp($date);
    }

    public function getDate($time = null) {
        return ZendX_Utilities_Date::getDate($time);
    }

    public function getEstatus($estatusId) {
        $estatus = 'N/D';
        switch ($estatusId) {
            case 1:
                $estatus = 'Activo';
                break;
            case -1:
                $estatus = 'Inactivo';
                break;
        }
        return $estatus;
    }

    public function getLastInsertId() {
        return $this->_lastInsertId;
    }

    public function setLastInsertId($lastInsertId) {
        $this->_lastInsertId = (int) $lastInsertId;
    }

}
