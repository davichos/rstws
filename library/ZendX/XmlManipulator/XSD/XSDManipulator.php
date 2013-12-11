<?php

/**
 * Class to manipulate XSD Files NOTE: improvement class
 * @package XmlManipulator
 * @subpackage XSD
 * @author David Gomez
 */
class ZendX_XmlManipulator_XSD_XSDManipulator {
    
    /**
     * @method __construct
     * @access public 
     */
    public function __construct() {
        
    }
    
    /**
     * method para abtener un array de elementos XSD
     * @param file $fileXSD the xsd file
     * @param string $varID the id attribute
     * @return 
     */
    public function xsdToArray( $fileXSD, $varID ) {
        $attributes = array ( );
        $xsdstring = $fileXSD;
        $XSDDOC = new DOMDocument();
        $XSDDOC -> preserveWhiteSpace = false;
        if ( $XSDDOC -> load( $xsdstring ) ) {
            $xsdpath = new DOMXPath( $XSDDOC );

            $attributeNodes =
                    $xsdpath ->
                    query( '//xs:element[@name="campo"]/xs:complexType/xs:sequence' )
                    -> item( 0 );
            foreach ( $attributeNodes -> childNodes as $attr ) {
                $attributes[ ] = $attr -> getAttribute( 'ref' );
            }
            $at = $xsdpath ->
                    query( '//xs:element[@name="campo"]/xs:complexType/xs:attribute[@name="' . $varID . '"]' )
                    -> item( 0 );
            $attributes[ ] = ( $at -> getAttribute( 'name' ));
            unset( $xsdpath );
        }
        return $attributes;
    }

}
