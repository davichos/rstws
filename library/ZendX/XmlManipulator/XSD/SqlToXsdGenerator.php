<?php

/**
 * Description of SqlToXsdGenerator
 * 
 * Library which is responsible for creating XSD file from a DB table obtained from a subject Zend_Db_Table_Abstract
 * @package XmlManipulator
 * @subpackage XSD
 * @author Davdi Gomez
 * 
 */
class ZendX_XmlManipulator_XSD_SqlToXsdGenerator {

    /**
     *
     * @var array
     */
    private $_arrayMetadata;

    /**
     *
     * @var file
     */
    private $_fileToSave;

    /**
     *
     * @param array $arrayMetadata (optinal)
     * @param file $fileToSave (optional) the file where is going to save the fileXML
     */
    public function __construct($arrayMetadata = null, $fileToSave = null) {
        $this->_arrayMetadata = $arrayMetadata;
        $this->_fileToSave = $fileToSave;
    }

    /**
     * Method to set the ArrayMetadata
     * @param array $arrayMetadata 
     */
    public function setArrayMetadata($arrayMetadata) {
        $this->_arrayMetadata = $arrayMetadata;
    }

    /**
     *
     * @param file $fileToSave the file where is going to save the fileXML
     */
    public function setFileToSave($fileToSave) {
        $this->_fileToSave = $fileToSave;
    }

    /**
     * method to get the arrayMetadata
     * @return array
     */
    protected function getArrayMetadata() {
        return $this->_arrayMetadata;
    }

    /**
     * method to get the file where is going to save the fileXML
     * @return file
     */
    protected function getFileToSave() {
        return $this->_fileToSave;
    }

    /**
     * method create the XSD file from Zend_Db_Table_Abstract object
     * @return DOMDocument 
     */
    public function sqlToXsdMaker($withId = true) {

        $doc = new DOMDocument('1.0', 'UTF-8');
        $root = $doc->createElement("xs:schema");
        $root->setAttribute("xmlns:xs", "http://www.w3.org/2001/XMLSchema");

        $doc->appendChild($root);
        $at1 = $doc->createElement("xs:simpleType");
        $at1->setAttribute("name", "AT_1");
        $root->appendChild($at1);

        $at2 = $doc->createElement("xs:restriction");
        $at2->setAttribute("base", "xs:string");
        $at1->appendChild($at2);

//        $at1 = $doc -> createElement( "xs:enumeration" );
//        $at1 -> setAttribute( "value", "" );
//        $at2 -> appendChild( $at1 );

        $at2 = $doc->createElement("xs:element");
        $at2->setAttribute("name", "contenido");
        $root->appendChild($at2);

        $at1 = $doc->createElement("xs:complexType");
        $at2->appendChild($at1);

        $at2 = $doc->createElement("xs:sequence");
        $at1->appendChild($at2);

        $at1 = $doc->createElement("xs:element");
        $at1->setAttribute("ref", "campo");
        $at1->setAttribute("maxOccurs", "unbounded");
        $at2->appendChild($at1);

        $at1 = $doc->createElement("xs:element");
        $at1->setAttribute("name", "campo");
        $root->appendChild($at1);

        $at2 = $doc->createElement("xs:complexType");
        $at1->appendChild($at2);

        $at1 = $doc->createElement("xs:sequence");
        $at2->appendChild($at1);
        foreach ($this->getArrayMetadata() as $value) {
            $at3 = $doc->createElement("xs:element");
            $at3->setAttribute("ref", $value['COLUMN_NAME']);
            $at3->setAttribute("minOccurs", $this->getOccurs($value));
            $at3->setAttribute("maxOccurs", "1");
            $at1->appendChild($at3);
            if (null !== $value['PRIMARY_POSITION']) {
                if ($value['PRIMARY_POSITION'] == 1)
                    $idName = $value['COLUMN_NAME'];
                $at3->setAttribute("minOccurs", "0");
            }
            $dataType = $this->_getDataType($value['DATA_TYPE']);
            $element = $doc->createElement("xs:element");
            $element->setAttribute("name", $value['COLUMN_NAME']);
            $element->setAttribute("type", $dataType);
            $root->appendChild($element);
        }

        $at1 = $doc->createElement("xs:attribute");
        $at1->setAttribute("name", $idName);
        $at1->setAttribute("type", "AT_1");
        $at1->setAttribute("use", "required");
        $at2->appendChild($at1);
        if ($doc->save($this->getFileToSave())) {
            return $this->getFileToSave();
        } else {
            return null;
        }
    }

    public function getOccurs($element) {
        if ($element['NULLABLE']) {
            return "0";
        } else {
            return "1";
        }
    }

    private function _getDataType($name) {
        $dataType = '';
        switch (strtoupper($name)) {
            case 'TINYINT':
                $dataType = 'xs:integer';
                break;
            case 'SMALLINT':
                $dataType = 'xs:integer';
                break;
            case 'MEDIUMINT':
                $dataType = 'xs:integer';
                break;
            case 'INT':
                $dataType = 'xs:integer';
                break;
            case 'INTEGER':
                $dataType = 'xs:integer';
                break;
            case 'BIGINT':
                $dataType = 'xs:long';
                break;
            case 'REAL':
                $dataType = 'xs:double';
                break;
            case 'DOUBLE':
                $dataType = 'xs:double';
                break;
            case 'FLOAT':
                $dataType = 'xs:float';
                break;
            case 'DECIMAL':
                $dataType = 'xs:decimal';
                break;
            case 'NUMERIC':
                $dataType = 'xs:decimal';
                break;
            case 'FIXED':
                $dataType = 'xs:decimal';
                break;
            case 'CHAR':
                $dataType = 'xs:string';
                break;
            case 'VARCHAR':
                $dataType = 'xs:string';
                break;
            case 'DATE':
                $dataType = 'xs:date';
                break;
            case 'TIME':
                $dataType = 'xs:time';
                break;
            case 'TIMESTAMP':
                $dataType = 'xs:dateTime';
                break;
            case 'DATETIME':
                $dataType = 'xs:dateTime';
                break;
            case 'YEAR':
                $dataType = 'xs:gYear';
                break;
            case 'TINYBLOB':
                $dataType = 'xs:string';
                break;
            case 'BLOB':
                $dataType = 'xs:string';
                break;
            case 'MEDIUMBLOB':
                $dataType = 'xs:string';
                break;
            case 'LONGBLOB':
                $dataType = 'xs:string';
                break;
            case 'TINYTEXT':
                $dataType = 'xs:string';
                break;
            case 'TEXT':
                $dataType = 'xs:string';
                break;
            case 'MEDIUMTEXT':
                $dataType = 'xs:string';
                break;
            case 'LONGTEXT':
                $dataType = 'xs:string';
                break;
            case 'ENUM':
                $dataType = 'xs:string';
                break;
            case 'SET':
                $dataType = 'xs:string';
                break;
            case 'BIT':
                $dataType = 'xs:integer';
                break;
            case 'BOOL':
                $dataType = 'xs:boolean';
                break;
            case 'BOOLEAN':
                $dataType = 'xs:boolean';
                break;
            default:
                $dataType = 'xs:string';
        }
        return $dataType;
    }

}
