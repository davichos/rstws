<?php

/**
 * Description of SqlToXsdHelper
 * Class to parse from Zend_Db_Table_Abstract object to XML schemafile
 * @method __construct
 * @method getTableModel 
 * @method setTableModel
 * @method generaXSD
 * @author David Gómez
 * @package Actions
 * @subpackage Helper
 * @access public
 */
class ZendX_Action_Helper_SqlToXsdHelper extends Zend_Controller_Action_Helper_Abstract {

    /**
     *
     * @var array $_metadato
     */
    protected $_metadato;

    /**
     *
     * @var string $_nombre
     */
    protected $_nombre;

    /**
     * gets the metadata array
     * @method getMetadata
     * @return type array
     */
    public function getMetadato() {
        return $this->_metadato;
    }

    /**
     * Sets the metadata array
     * @method setMetadata
     * @param array $metadata 
     */
    public function setMetadato($metadato) {
        $this->_metadato = $metadato;
    }

    /**
     * Gets the name value
     * @method getName
     * @return string
     */
    public function getNombre() {
        return $this->_nombre;
    }

    /**
     * Sets the name value
     * @method getName
     * @param string $name 
     */
    public function setNombre($nombre) {
        $this->_nombre = $nombre;
    }

    /**
     * @method generaXSD
     * Calls to the generated method the XSD document
     * @param array $arrayMetadata
     * @param string $name
     * @return DomDocument|null if the file was created
     */
    public function generaXSD($arrayMetadata = null, $name = null, $withId = true) {
        $rtrn = null;
        if (!is_null($arrayMetadata)) {
            $this->setMetadato($arrayMetadata);
        }
        if (!is_null($name)) {
            $this->setNombre($name);
        }
        if (!is_null(($this->getMetadato()))) {
            $arrayMetadata = $this->getMetadato();
            $name = $this->getNombre();
            if (count($arrayMetadata) > 0) {
                $xsd = new ZendX_XmlManipulator_XSD_SqlToXsdGenerator();
                $xsd->setArrayMetadata($this->getMetadato());
                $xsd->setFileToSave($this->getNombre());
                $rtrn = $xsd->sqlToXsdMaker($withId);
            }
        }
        return $rtrn;
    }

}

