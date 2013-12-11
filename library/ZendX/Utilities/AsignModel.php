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
class ZendX_Utilities_AsignModel extends ZendX_Utilities_Bd implements ZendX_Utilities_Interfaces_AsignaBd {

    public function asignModel($id) {
        switch ((int)$id) {
            case 1:
                $this->setBd('Admin_Model_JosfacturasMapper');
                $this->setModel('Admin_Model_Josfacturas');
                break;
            default:
                $this->setModel(null);
                $this->setBd(null);
        }
    }

    public function save(array $data) {
        try {
            $this->getModel()->setOptions($data);
            if ($this->getBd()->write($this->getModel())) {
                return true;
            } else {
                return false;
            }
        } catch (Zend_Exception $e) {
            return false;
        }
    }

    public function getMetadata() {
        if (!is_null($this->getBd()))
            return $this->getBd()->getMetadata();
        else
            return null;
    }

}

