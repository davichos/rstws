<?php

/**
 * Description of Bd
 *
 * @author DGomez
 */
class ZendX_Utilities_Bd {

    //put your code here
    protected $_bd;
    protected $_model;
    protected $_idKeyName;

    public function __construct($bd = null, $model = null) {
        $this->setBd($bd);
        $this->setModel($model);
    }

    public function getBd() {
        return $this->_bd;
    }

    public function setBd($bd) {
        if (null !== $bd) {
            $this->_bd = $bd;
        } else {
            $this->_bd = null;
        }
        return $this;
    }

    public function getModel() {
        return $this->_model;
    }

    public function setModel($model) {
        if (!is_null($model)) {
            $this->_model = $model;
        } else {
            $this->_model = null;
        }
        return $this;
    }

    public function getIdKeyName() {
        return $this->_idKeyName;
    }

    public function setIdKeyName($idKeyName) {
        $this->_idKeyName = $idKeyName;
    }

}
