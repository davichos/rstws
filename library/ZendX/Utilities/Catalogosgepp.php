<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogos
 *
 * @author DGomez
 */
class ZendX_Utilities_Catalogosgepp extends ZendX_Utilities_Bd implements ZendX_Utilities_Interfaces_AsignaBd {

    //put your code here

    public function asignModel($id) {
        switch (strtolower($id)) {
//            case 'puesto':
//                $this->setBd('Gepp_Model_CatpuestoMapper');
//                $this->setModel('Gepp_Model_Catpuesto');
//                break;
//            case 'tipo_ruta':
//                $this->setBd('Gepp_Model_PartiporutaMapper');
//                $this->setModel('Gepp_Model_Partiporuta');
//                break;
            default:
                $this->setBd(null);
                $this->setModel(null);
        }
    }

    public function getMetadata() {
        if (!is_null($this->getBd()))
            return $this->getBd()->getMetadata();
        else
            return null;
    }

    public function save(array $data) {
        if (!is_null($this->getBd())) {
            return $this->getBd()->write($data);
        }
    }

    public function find($name) {
        $return = null;
        if (!is_null($this->getBd()) && !is_null($name)) {
            $result = $this->getBd()->getNametoId($name);
            if (!is_null($result)) {
                $return = $result;
            } else {
                $data = array('nombre' => $name);
                $return = $this->save($data);
            }
        }
        $this->setModel(null);
        $this->setBd(null);
        return $return;
    }

}

