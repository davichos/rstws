<?php

/**
 * Class to validate an XML file from an XSD
 * @package XmlManipulator
 * @subpackage XML
 * @author Davdi Gomez
 * @uses ZendX_XmlManipulator_XML_FileXML
 */
class ZendX_XmlManipulator_XML_XMLValidator extends ZendX_XmlManipulator_XML_FileXML {

    /**
     * @method __construct
     * @access public 
     */
    public function __construct() {
        
    }

    /**
     *
     * @param string $fileXML the file XML
     * @param string $fileXsd the file XSD
     * @return boolean true|false
     */
    public function validaXML( $fileXML, $fileXsd ) {
        $status = false;
        libxml_use_internal_errors( true );

        /* creating a DomDocument object */
        $objDom = new DomDocument();

        /* loading the xml data */

        if ( $objDom -> load( $fileXML ) ) {

            /**
             * if you want to use a xml file instead of a string, it can be loaded like this:
             * $objDom->load("path/to/xml");
             */
            /* tries to validade your data */
            if ( !$objDom -> schemaValidate( $fileXsd ) ) {
                /* if anything goes wrong you can get all errors at once */
                $allErrors = libxml_get_errors();
                /* each element of the array $allErrors will be a LibXmlError Object */
                return $allErrors;
            } else {
                $status = true;
            }
        }
        return $status;
    }

}

