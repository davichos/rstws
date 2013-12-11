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
class ZendX_Excel_ReadExcel_ExcelToXml {

    //put your code here
    public function __construct() {
        
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
                $modelo = new ZendX_Utilities_Catalogos();
                list($num_cols, $num_rows) = $xlsx->dimension();
                $file = fopen($nombreXml, 'w+');
                fwrite($file, '<?xml version="1.0" encoding="UTF-8"?>' . chr(13) . chr(10));
                fwrite($file, '<contenido>' . chr(13) . chr(10));
                $columnas = array();
                $j = 0;                
                foreach ($xlsx->rows() as $r) {
                    if ($j != 0) {
                        fwrite($file, '<campo id="' . $j . '">' . chr(13) . chr(10));
                        for ($i = 0; $i < $num_cols; $i++) {
                            if (array_key_exists($i, $r)) {
                                $idM = $modelo->find($columnas[$i],$r[$i]);
                                if (null !== $idM) {
                                    $r[$i] = $idM;
                                } else {
                                    if (preg_match('/fecha/', strtolower($columnas[$i]))) {
                                        $timestamp = PHPExcel_Shared_Date::ExcelToPHP($r[$i] + 1);
                                        $fecha = date("Y-m-d", $timestamp);
                                        $r[$i] = $fecha;
                                    }
                                }
                                fwrite($file, '<' . $columnas[$i] . '>' . $r[$i] . '</' . $columnas[$i] . '>' . chr(13) . chr(10));
                            }
                        }
                        fwrite($file, '</campo>' . chr(13) . chr(10)); // . chr(13) . chr(10));
                    } else {
                        for ($i = 0; $i < $num_cols; $i++) {
                            if (array_key_exists($i, $r)) {
                                $columnas[$i] = $this->_getRealColumnName($r[$i]);
                            }
                        }
                    }
                    $j++;
                }
                fwrite($file, '</contenido>' . chr(13) . chr(10));
                fclose($file);
                return 'true';
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return 'El archivo no existe';
        }
    }

    private function _getRealColumnName($name) {
        
        $realName = str_replace(' ', '_', strtolower($name));
//        var_dump($realName);
        switch ($realName) {
            case 'nombre_de_la_factura':
            case 'nombre_de_la_nota':
                $realName = 'name';
                break;
            case 'usuario':
                $realName='user';
                break;
            case 'no._de_nota':
            case 'no._factura':
                $realName='factura';
                break;
            case 'fecha_de_factura':
            case 'fecha_de_nota':
                $realName='fecha_fac';
                break;
            case 'fecha_de_ingreso':
                $realName='fecha_act';
                break;
            case 'fecha_de_Última_actualización':
            case 'fecha_de_última_actualización':
            case 'fecha_de_ultima_actualizacion':
                $realName='fecha_last';
                break;
            case 'producto':
                $realName='no_ident';
                break;
            case 'estatus':
                $realName='status';
                break;    
            case 'descripción':
                $realName='descripcion';
                break;    
        }
        return $realName;
    }

}

