<?php

/**
 * Class to query collections of XML data
 * @package XmlManipulator
 * @subpackage XML
 * @author Davdi Gomez
 * @uses ZendX_XmlManipulator_XML_FileXML
 */
class ZendX_XmlManipulator_XML_Xquery extends ZendX_XmlManipulator_XML_FileXML {

    /**
     * @method __construct
     * @access public 
     */
    public function __construct() {
        
    }

    /**
     * file XML defined Previously by setter method
     * @param string $condition the query
     * @return nodeList 
     * 
     */
    public function xQueryEjecutor( $query ) {
        $nodeList = null;
        $xmlDocument = new DOMDocument();
        if ( $xmlDocument -> load( $this -> getFileXML() ) ) {
            $xpath = new DOMXPath( $xmlDocument );
            $nodeList = $xpath -> query( $query, $xmlDocument );
        }
        return $nodeList;
    }

}

