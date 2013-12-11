<?php

/**
 * Description of ConcentradoGanadores
 *
 * @author DGomez
 */
class ZendX_Utilities_Addusers extends ZendX_Utilities_Bd implements ZendX_Utilities_Interfaces_AsignaBd {

    public function asignModel($id) {
        switch ((int) $id) {
            case 2:
                $this->setBd('Cnv_Model_FuerventmyMapper');
                $this->setModel('Cnv_Model_Fuerventmy');
                break;
            case 3:
                $this->setBd('Cnv_Model_FuerventmnMapper');
                $this->setModel('Cnv_Model_Fuerventmn');
                break;
            case 4:
                $this->setBd('Cnv_Model_RifalapMapper');
                $this->setModel('Cnv_Model_Rifalap');
                break;
            case 5:
                $this->setBd('Cnv_Model_RifautoMapper');
                $this->setModel('Cnv_Model_Rifauto');
                break;
            case 6:
                $this->setBd('Cnv_Model_GerentescooMapper');
                $this->setModel('Cnv_Model_Gerentescoo');
                break;			
			case 7:                
				$this->setBd('Cnv_Model_ConcnoganadoresMapper');                
				$this->setModel('Cnv_Model_Concnoganadores');                
				break;	
				
            default:
                $this->setModel(null);
                $this->setBd(null);
        }
    }

    public function getMetadata() {
        if (!is_null($this->getBd()))
            return $this->getBd()->getMetadata();
        else
            return null;
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

    public function saveCatalogo(array $data) {
        $this->getModel()->setOptions($data);
        try {
            if ($this->getBd()->writeCat($this->getModel())) {
                return true;
            } else {
                return false;
            }
        } catch (Zend_Exception $e) {
            return false;
        }
    }

    public function consulta($estado=1, $esquema='') {
        $result = array();
		
        if (!is_null($this->getBd()))
            $result = $this->_bd->addUsers($estado, $esquema);
        else
            $result = array();				
		
        return $result;
    }

    public function cambiaElemento($elemento, array $condicion, $valor) {
        $result = array();
        if (!is_null($this->getBd())) {
            $result = $this->find($condicion);
            foreach ($result as $item) {
                $data = $this->getData($elemento, $item, $valor);
                if ($elemento === 'estado')
                    $this->save($data);
                else
                    $this->saveCatalogo($data);
            }
        } else {
            $result = array();
        }
        return $result;
    }

    private function find($condicion) {
        $tabla = $this->getBd()->getDbTable();
        $select = $tabla->select();
        foreach ($condicion as $key => $value) {
            $select->where($key . '=?', $value);
        }
        $result = $tabla->fetchAll($select);
        return $result;
    }

    private function getData($elemento, $item, $valor) {
        $data = array();
        foreach ($item as $key => $val) {
            $key = str_replace('_', $replace, $key);
            if ($key === $elemento) {
                $val = $valor;
            }
            $data[$key] = $val;
        }
        return $data;
    }

}

