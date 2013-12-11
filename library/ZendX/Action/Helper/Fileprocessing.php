<?php

/**
 * Description of FileProcessing
 *
 * @author DGomez
 */
class ZendX_Action_Helper_Fileprocessing extends Zend_Controller_Action_Helper_Abstract {

    public function processFile($procesar) {
        ini_set("memory_limit", "256M");
        libxml_use_internal_errors(true);
        $msjArray = array();
        $error = null;
        $fileXSD = '';
        $xmlFileName = '';
        if (!is_null($procesar)) {
            $registro = Zend_Registry::getInstance();
            $option = $registro->get('file');
            $model = new ZendX_Utilities_AsignModel();
            $excel = new ZendX_Excel_ReadExcel_ExcelToXml();
            $excelFileName = $option['path'] . $procesar->getNombrearchivo();
            $xmlFileName = str_replace('.xlsx', '.xml', $excelFileName);
            $xsdFileName = str_replace('.xlsx', '.xsd', $excelFileName);
            $status = $excel->leeExcel($excelFileName, $xmlFileName);
            if ($status == 'true') {
                $model->asignModel($procesar->getIdtemplate());
                if (!is_null($model->getBd())) {
                    $info = $model->getMetadata();
                    $sql = new ZendX_Action_Helper_SqlToXsdHelper();
                    $fileXSD = $sql->generaXSD($info['metadata'], $xsdFileName);
                    $doc = new DOMDocument();
                    $doc->load($xmlFileName);
                    if ($doc->schemaValidate($fileXSD)) {
                        $xmlToArray = new ZendX_XmlManipulator_XML_Xml2Array();
                        $contents = file_get_contents($xmlFileName); //Or however you what it
                        $result = $xmlToArray->parser($contents, 0);
                        $data = null;
                        foreach ($result['contenido']['campo'] as $key => $re) {
                            if (is_array($re)) {
                                $arr = array_merge(array('id' => '0'), $this->replace($re));
                                $error = $model->save($arr);
                            } else {
                                $key = $this->replace($key);
                                $data[$key] = $re;
                            }
                            if (!is_null($data)) {
                                $data = array_merge(array('id' => '0'), $data);
                                $error = $model->save($data);
                            }
                        }
                        if (!$error) {
                            $msjArray['Se cargo con éxito '] = 'El archivo se procesó correctamente';
                        } else {
                            $msjArray['Error de escritura '] = 'El archivo no se guardo correctamente en la BD';
                        }
                    } else {
                        $msjArray['Error de estructura de archivo '] = 'La estructura del archivo no coincide con la estructura esperada';
                        foreach (libxml_get_errors() as $er) {
                            $msjArray[$er->line] = $er->message;
                        }
                        $error = true;
                    }
                } else {
                    $msjArray['Error de archivo '] = 'El id_template asignado no existe';
                    $error = true;
                }
            } else {
                $msjArray['Error de archivo '] = $status;
                $error = true;
            }
//            var_dump($msjArray);
            $this->writeMessage($msjArray, $procesar->getIdtemplate());
        }
        if (file_exists($fileXSD))
            unlink($fileXSD);
        if (file_exists($xmlFileName))
            unlink($xmlFileName);
        return $error;
    }

    private function writeMessage($msjArray, $idTemplate) {
        try {
            $msjAnt = '';
            $msjFin = '';
            $asunto = '';
            foreach ($msjArray as $key => $msj) {
                if ($msjAnt !== $msj) {
                    $msjAnt = $msj;
                    $msjFin.=$msj . "\n";
                }
                if (is_string($key)) {
                    $asunto = $key;
                }
            }
            $fileName = $this->_getFileName($idTemplate);
            $asunto .= " " . $fileName;
            $this->_writeBandeja($asunto, $msjFin);
        } catch (Exception $e) {
            
        }
    }

    private function _writeBandeja($asunto, $msj) {
        $ban = new Admin_Model_Modbandeja();
        $bandejaM = new Admin_Model_ModbandejaMapper();
        $ban->setId(0);
        $ban->setAsunto($asunto);
        $ban->setMensaje($msj);
        $fecha = new Zend_Date();
        $ban->setFecha($fecha->getTimestamp());
        $ban->setEstado(1);
        $bandejaM->write($ban);
    }

    private function _getFileName($idTemplate) {
        $temlate = new Admin_Model_CattemplateMapper();
        return $temlate->getFileName($idTemplate);
    }

    public function parseData(array $datos, array $bdInfo) {
        $arr = array();
        $arrayMeta = $bdInfo['metadata'];
        foreach ($datos as $key => $dato) {
            if (array_key_exists($key, $arrayMeta)) {
                switch (strtoupper($arrayMeta[$key]['DATA_TYPE'])) {
                    case 'TINYINT':
                    case 'SMALLINT':
                    case 'MEDIUMINT':
                    case 'INT':
                    case 'INTEGER':
                    case 'BIGINT':
                        $dato = (int) $dato;
                        break;
                    case 'REAL':
                    case 'DOUBLE':
                        $dato = doubleval($dato);
                        break;
                    case 'FLOAT':
                    case 'DECIMAL':
                    case 'NUMERIC':
                    case 'FIXED':
                        $dato = floatval($dato);
                        break;
                    case 'BOOL':
                    case 'BOOLEAN':
                        $dato = (boolean) $dato;
                        break;
                    default:
                        $dato = (string) $dato;
                }
                $datos[$key] = $dato;
            }
        }
        return $datos;
    }

    public function replace($data, $ch1 = '_', $ch2 = '') {
        $newArray = array();
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (empty($value) || is_null($value)) {
                    $value = '';
                }
                $key = str_replace($ch1, $ch2, $key);
                $newArray[$key] = $value;
            }
        } else {
            $newArray = str_replace($ch1, $ch2, $data);
        };
        return $newArray;
    }

}

