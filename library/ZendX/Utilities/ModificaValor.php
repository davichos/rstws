<?php

/**
 * Ayuda para modificar el valor del XML
 * @package Utilities
 * @author David Gomez
 */
class ZendX_Utilities_ModificaValor {

    /**
     *
     * @param int $idCola
     * @param int $estado
     * @param ZendX_Actions_Helper_FTPConection $helperFTP
     * @return string 
     */
    public function modifica($idCola, $estado, $helperFTP) {
        $xmlNameFile = Zend_Registry::get('localXMLFile');
        $remoteFileXML = Zend_Registry::get('remoteXMLFile');
        if ($helperFTP->getFile($remoteFileXML, $xmlNameFile)) {
            $xml = new ZendX_XmlManipulator_XML_XMLManipulator();
            $xml->setFileXML($xmlNameFile);
            if ($xml->modifyValueXMLNode('file', 'id', $idCola, 'estado', $estado)) {
                if ($helperFTP->putFile($remoteFileXML, $xmlNameFile)) {
                    $msj = 'El archivo xml se colco y modifico correctamente';
                } else {
                    $msj = 'No se pudo colocar el xml en el ftp';
                }
            } else {
                $msj = 'No se pudo modificar el xml';
            }
        } else {
            $msj = 'No se pudo obtener el xml del ftp';
        }
        return $msj;
    }

}

