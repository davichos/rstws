<?php

/**
 * Creates a excel file 2003 from Array
 * @package Excel
 * @subpackage Template
 * @author David Gomez
 */
class ZendX_Excel_Template_fromGrid_GenerateFile {

    public function __construct() {
        
    }

    public function generateFile($table, $name, $extension, $sign = false, $params = array(), $lock = false, $unlock = null) {
        if (!empty($table)) {
            $objPHPExcel = new PHPExcel();
            date_default_timezone_set('America/Mexico_City');
            if (!empty($params)) {
                $template = $params['template'];
                $name=$template['concepto'];
                $objPHPExcel->getProperties()
                        ->setSubject($template['firma'])
                        ->setDescription($template['nombre_sellado'])
                        ->setKeywords($template['firma'])
                        ->setCompany("Adventa Soluciones")
                        ->setCategory($params['id']);
            }
            $objPHPExcel->getProperties()
                    ->setCreator("Lic. David Gomez")
                    ->setLastModifiedBy("Lic. David Gomez")
                    ->setTitle($name);
            $j = 1;

            foreach ($table as $values) {
                $i = 65;
                foreach ($values as $value) {
                    $objPHPExcel
                            ->setActiveSheetIndex(0)
                            ->setCellValue(chr($i) . $j, str_replace('\\', '', (str_replace('"', '', $value))));
                    if ($unlock !== null) {
                        $objPHPExcel->getActiveSheet()
                                ->getStyle($unlock . $j)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                    }
                    $i++;
                }
                $j++;
            }
            if ($lock) {
                $objPHPExcel->getActiveSheet()
                        ->getProtection()
                        ->setSheet(true);
            }
            $objPHPExcel->getActiveSheet()->setTitle($name);

            $name = $name . $extension;
            /* header('Content-Disposition: attachment; filename=' . urlencode($name));
              header('Content-type: application/vnd.ms-excel');
              header('Content-Type: application/force-download');
              header('Content-Type: application/octet-stream');
              header('Content-Type: application/download');
              header('Content-Description: File Transfer'); */



//header('Content-Type: application/download');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $name . '"');
            header('Cache-Control: max-age=0');
//header('Content-Disposition: attachment; filename=' . $name);
//header('Content-type: application/vnd.ms-excel');
//header('Content-Type: application/force-download');
//header('Content-Type: application/octet-stream');
//header('Content-Description: File Transfer');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
            $objWriter->save('php://output');

// echo file_get_contents($name);
//unlink($name);
        }
    }

}

