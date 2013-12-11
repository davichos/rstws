<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Reads the data excel and creates the file XML
 * @package Excel
 * @subpackage ReadExcel
 * @author David Gomez
 */
class ZendX_Excel_ReadExcel_ExcelToXmlGepp {

    private $_esquema;

    //put your code here
    public function __construct($esquema) {
        if (is_null($esquema)) $esquema = 0;
        $this->_esquema = (int) $esquema;
    }

    /**
     *
     * @param string $excelFileName
     * @param int $idVar
     * @param string $nombreXml
     * @param string $nombreXSD
     * @return boolean
     */
    public function leeExcel($excelFileName, $nombreXml) {

        date_default_timezone_set('America/Mexico_City');

        if (file_exists($excelFileName)) {
            try {
                $xlsx = new ZendX_Excel_ReadExcel_SimpleXlsx($excelFileName);
                $cedisM = new Gepp_Model_CatcedisMapper();
                $modelo = new ZendX_Utilities_Catalogosgepp();
                list($num_cols, $num_rows) = $xlsx->dimension();
                $file = fopen($nombreXml, 'a+');
                fwrite($file, '<?xml version="1.0" encoding="UTF-8"?>'); //. chr(13) . chr(10));
                fwrite($file, '<contenido>' . chr(13) . chr(10));
                $columnas = array();
                $j = 0;
                foreach ($xlsx->rows() as $r) {
                    if ($j != 0) {
                        fwrite($file, '<campo id="' . $j . '">');
                        for ($i = 0; $i < $num_cols; $i++) {
                            /*if (!empty($r[$i])) {
                            /* cambios no se van a definir ids nuevos tipo_ruta ni puesto */
                            /*
                              $modelo->asignModel($columnas[$i]);
                              $idM = $modelo->find($r[$i]);
                              if (!is_null($idM)) {
                              $r[$i] = $idM;
                              } else { */
                            if (preg_match('/fecha/', strtolower($columnas[$i]))) {
                                $timestamp = PHPExcel_Shared_Date::ExcelToPHP($r[$i]);
                                $fecha = date("Y-m-d", $timestamp);
                                $jsn = new ZendX_Action_Helper_Jsontoarray();
                                $r[$i] = $jsn->getTimeStamp($fecha);
                            }
                            if (preg_match('/cedis/', strtolower($columnas[$i])) && $this->_esquema === 1) {
                                $cedis = new Gepp_Model_Catcedis();
                                if ($cedisM->findCedis($r[$i])) {
                                    $cedis->setIdgerencia($r[0])
                                            ->setIdregion($r[1])
                                            ->setJefeventas($r[2])
                                            ->setDescripcion($r[3])
                                            ->setIddep($r[4])
                                            ->setCiudad("")
                                            ->setDomicilio("")
                                            ->setEstado("")
                                            ->setIdterritorio(0);
                                    $r[$i] = $cedisM->write($cedis);
                                }
                            }
                            if (preg_match('/cedis/', strtolower($columnas[$i]))) {
                                $r[$i] = $cedisM->getCedistoid($r[$i]);
                            }
                            /* //cambios } */
                            fwrite($file, '<' . $columnas[$i] . '>' .
                                    $r[$i] . '</' . $columnas[$i] . '>');
                            /*}*/
                        }
                        fwrite($file, '</campo>');
                    } else {
                        for ($i = 0; $i < $num_cols; $i++) $columnas[$i] = $r[$i];
                    }
                    $j++;
                }
                fwrite($file, '</contenido>');
                fclose($file);
                return 'true';
            } catch (Exception $e) {
                if (file_exists($nombreXml)) unlink($nombreXml);
                return $e->getMessage();
            }
        } else {
            return 'El archivo no existe';
        }
    }

}

