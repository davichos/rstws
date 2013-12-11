<?php

class ZendX_Action_Helper_Admin_Phpexceladmin extends Zend_Controller_Action_Helper_Abstract {

    protected $_data;
    protected $_filetmp;

    public function setData($data) {
        $this->_data = $data;
    }

    public function save() {
    	date_default_timezone_set('America/Mexico_City');
        $cols = $this->_getMetada();
        $template = $this->_getTemplate();
        $id = $this->_getId();
        $objPHPExcel = new PHPExcel();
        $ids = $this->_getIds();
        $objPHPExcel->getProperties()->setCreator("Ing. Eduardo Ortiz Andrade")
                ->setLastModifiedBy("Ing. Eduardo Ortiz Andrade")
                ->setTitle($template['concepto'])
                ->setSubject($template['firma'])
                ->setDescription($template['nombre_sellado'])
                ->setKeywords($template['firma'])
                ->setCompany("Adventa Soluciones")
                ->setManager("Ing. Eduardo Ortiz Andrade")
                ->setCategory($id);
        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(count($cols));
        $i = 0;
        foreach ($cols as $item) {
            if ($item !== null && !array_key_exists( $item, $ids)) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValueByColumnAndRow($i, 1, $item);
                $i++;
            }
        }
        // renombra hoja
        $objPHPExcel->getActiveSheet()->setTitle($template['concepto']);

        // Conjunto de �ndices de hoja activa , por lo que Excel se abre con la primera hoja
        $objPHPExcel->setActiveSheetIndex(0);

        //configura la version de excel	
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        return $objWriter->save('php://output');
    }

    public function readMetada($version=null) {
        date_default_timezone_set('America/Mexico_City'); 
        ini_set("memory_limit","256M");
    	$valido = false;        
        switch ($version) {
            case "excel2007":
                $objReader = new PHPExcel_Reader_Excel2007();
                $objExcel = $objReader->load($this->_filetmp);
                $param = array(
                    'id' => $objExcel->getProperties()->getCategory(),
                    'nombresellado' => $objExcel->getProperties()->getDescription(),
                    'firma' => $objExcel->getProperties()->getSubject()
                );
                $valido = $param;
                break;

            default: $valido = false;
        }
        return $valido;
    }

    private function _getMetada() {
        $cols = $this->_data['info']['cols'];
        return $cols;
    }

    private function _getTemplate() {
        $template = $this->_data['template'];
        return $template;
    }

    private function _getId() {
        $id = $this->_data['id'];
        return $id;
    }

    private function _getIds() {
        $ids = array();
        foreach ($this->_data['info']['metadata'] as $value) {
            if (!is_null($value['PRIMARY_POSITION'])) {
                $ids[$value['COLUMN_NAME']]=$value['PRIMARY_POSITION'];
            }
        }
        return $ids;
    }

    public function setPathtmp($filetmp) {
        $this->_filetmp = $filetmp;
    }

}