<?php

/**
 * Is a class to set and get files XML and XSD
 * @package XmlManipulator
 * @subpackage XML
 * @author David Gomez
 */
class ZendX_XmlManipulator_XML_FileXML {

    /**
     * @access protected
     * @var string Path to File XML
     */
    protected $_fileXML;

    /**
     * @access protected
     * @var string Path to File XSD
     */
    protected $_fileXSD;

    /**
     * @access public
     * @param string $fileXML  Path to File XML
     * @param string $fileXSD  Path to File XSD
     */
    public function __construct( $fileXML = null, $fileXSD = null ) {
        $this -> _fileXML = $fileXML;
        $this -> _fileXSD = $fileXSD;
    }

    /**
     * @access public
     * @return string $fileXML  Path to File XML
     */
    public function getFileXML() {
        return $this -> _fileXML;
    }

    /**
     * @access public
     * @param string $fileXML  Path to File XML
     */
    public function setFileXML( $fileXML ) {
        $this -> _fileXML = $fileXML;
    }

    /**
     * @access public
     * @return string $fileXSD  Path to File XSD
     */
    public function getFileXSD() {
        return $this -> _fileXSD;
    }

    /**
     * @access public
     * @param string $fileXSD Path to File XSD
     */
    public function setFileXSD( $fileXSD ) {
        $this -> _fileXSD = $fileXSD;
    }

}

