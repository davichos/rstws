<?php

/**
 * Description of AsignModel
 *
 * @author DGomez
 */
class ZendX_Utilities_AsignModelGepp extends ZendX_Utilities_Bd implements ZendX_Utilities_Interfaces_AsignaBd {

    public function asignModel($id) {
        switch ((int) $id) {
            case 1:
                $this->setBd('Gepp_Model_PicsMapper');
                $this->setModel('Gepp_Model_Pics');
                break;
            case 2:
                $this->setBd('Gepp_Model_DinamicageppMapper');
                $this->setModel('Gepp_Model_Dinamicagepp');
                break;
            case 3:
                $this->setBd('Gepp_Model_FaltasMapper');
                $this->setModel('Gepp_Model_Faltas');
                break;
            case 4:
                $this->setBd('Gepp_Model_ParticipantesMapper');
                $this->setModel('Gepp_Model_Participantes');
                break;
            case 5:
                $this->setBd('Gepp_Model_RotacionMapper');
                $this->setModel('Gepp_Model_Rotacion');
                break;
			case 6:
                $this->setBd('Gepp_Model_ModculturavialMapper');
                $this->setModel('Gepp_Model_Modculturavial');
                break;
            default:
                $this->setModel(null);
                $this->setBd(null);
        }

    }

    public function save(array $data) {
        $this->getModel()->setOptions($data);
        try {
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
        if (!is_null($this->getBd())) return $this->getBd()->getMetadata();
        else return null;

    }

}

