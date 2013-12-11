<?php

/**
 * Creates a excel file 2003 from DB model
 * @package Excel
 * @subpackage Template
 * @author David Gomez
 */
class ZendX_Excel_Template_fromBD_TemplateFromBD{

    /**
     *  
     */
    public function __construct(){
        
    }

    /**
     * Generates the excel file from BD 
     * @param array $metadata
     * @param string $name 
     */
    public function generateTemplate(array $metadata,$name){

        $i=65;

        $objPHPExcel=new PHPExcel();

        $objPHPExcel->getProperties()
                ->setCreator("David Gomez")
                ->setLastModifiedBy("David Gomez")
                ->setTitle($name)
                ->setSubject("template for reporting information");

        foreach($metadata as $value){
            $objPHPExcel->
                    setActiveSheetIndex(0)
                    ->
                    setCellValue(chr($i).'1',$value);
            $i++;
        }

        $objPHPExcel->
                getActiveSheet()->
                setTitle($name);
        $name=$name.".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$name);
        header('Cache-Control: max-age=0');

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $objWriter->save('php://output');
    }

}

