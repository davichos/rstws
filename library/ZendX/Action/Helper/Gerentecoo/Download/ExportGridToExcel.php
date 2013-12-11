<?php

/**
 * Description of ExportGridToExcel
 *
 * @author DGomez
 */
class ZendX_Action_Helper_Gerentecoo_Download_ExportGridToExcel extends Zend_Controller_Action_Helper_Abstract {

//put your code here
    private function toArray($str) {
        $arrayTemp = explode(';', $str);
        $array = array();
        foreach ($arrayTemp as $value) {
            $array[] = explode('|', $value);
        }
        return $array;
    }

    public function exportGrid($str, $name, $extension, $sign = false, $params = array(), $lock = false, $unlock = null) {
        $template = new ZendX_Excel_Template_fromGrid_GenerateFile();
        $template->generateFile($this->toArray($str), $name, $extension, $sign, $params, $lock, $unlock);
    }

}

