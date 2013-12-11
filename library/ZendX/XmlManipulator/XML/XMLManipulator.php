<?php

/**
 * Class to manipulate files XML NOTE: improvement class
 * @package XmlManipulator
 * @subpackage XML
 * @author Davdi Gomez
 * @uses ZendX_XmlManipulator_XML_FileXML
 */
class ZendX_XmlManipulator_XML_XMLManipulator extends ZendX_XmlManipulator_XML_FileXML {

    /**
     * @method __construct
     * @access public 
     */
    public function __construct() {
        
    }

    /**
     * Method to delete a node from XML file
     * @param string $element the element to delete
     * @param string $attribute the attribute name
     * @param string $attributeValue the attribute value
     * @return boolean true|false
     */
    public function deleteNode($element, $attribute, $attributeValue) {
        $status = false;
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;
        $dom->validateOnParse = true;
        if ($dom->load($this->getFileXML())) {
            $nodes = $dom->getElementsByTagName($element);
            foreach ($nodes as $node) {
                if ($node->getAttribute($attribute) == $attributeValue) {
                    while ($node->hasChildNodes()) {
                        $node->removeChild($node->childNodes->item(0));
                    }//fin while 
                    $node->removeAttribute($element);
                    $node->parentNode->removeChild($node);
                    $status = true;
                }//fin if attribute
            }//end for each nodes
            if ($dom->save($this->getFileXML())) {
                $status = true;
            } //end if save
        }//end if load
        return $status;
    }

    /**
     *
     * @param string $uniqIdName the attribute ID to create XML
     */
    public function CreateXML(string $uniqIdName) {

        $doc = new DOMDocument('1.0', 'UTF-8');

        if ($doc->load($this->getFileXML())) {
            $root = $doc->getElementsByTagName('files')->item(0);
        } else {
            $root = $doc->createElement("files");
            $doc->appendChild($root);
        }

        $newFile = $doc->createElement("file");
        $newFile->setAttribute('id', $uniqIdName);
        $directory = $doc->createElement("directorio", "directory");
        $ip = $doc->createElement("ip", ip2long(ZendX_Utilities_Ip_IpClient::getRealIP()));
        $date = $doc->createElement("fecha", date("c", (time() - 21600)));
        $status = $doc->createElement("estado", "0");
        $action = $doc->createElement("accion", "0");
        $numberXSD = $doc->createElement('numberXSD', Zend_Registry::get('numberXSD'));

        $newFile->appendChild($directory);
        $newFile->appendChild($ip);
        $newFile->appendChild($date);
        $newFile->appendChild($status);
        $newFile->appendChild($action);
        $newFile->appendChild($numberXSD);

        $root->appendChild($newFile);

        $doc->save($this->getFileXML());

        unset($doc);
    }

    /**
     *
     * @param string $element the element name
     * @param string $attribute the attribute name
     * @param string $attributeValue the attribute value
     * @param string $nodeName the node name
     * @param string $nodeValue the node value
     * @return true|false
     */
    public function modifyValueXMLNode($element, $attribute, $attributeValue, $nodeName, $nodeValue) {
        $status = false;
        $query = '//' . $element . "[@" . $attribute . "='" . $attributeValue . "']/" . $nodeName;
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;
        $dom->validateOnParse = true;
        $file = ($this -> getFileXML());
        if ( $dom -> load( $file ) ) {
            $xpath = new DOMXPath( $dom );
            $nodes = $xpath -> query( $query );
            foreach ( $nodes as $node ) {
                $node -> nodeValue = $nodeValue;
            }
            if ( $dom -> save( $this -> getFileXML() ) ) {
                $status = true;
            }
        }
        return $status;
    }

}

