<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExportGrid
 *
 * @author DGomez
 */
class ZendX_Action_Helper_Gerentecoo_Download_ExportGridPDF extends Zend_Controller_Action_Helper_Abstract {

    private function toArray($str) {
        $arrayTemp = explode(';', $str);
        $array = array();
        foreach ($arrayTemp as $value) {
            $array[] = explode('|', $value);
        }
        return $array;
    }
    public function exportGridToPDF($str,$name) {
        $pdf = new ZendX_pdf_CreaFilePDF();
        $data = $pdf->setData($this->toArray($str));
        $pdf->SetFont('Arial', '', 9);
        $pdf->AddPage('L', 'letter');
        $pdf->FancyTable();
        $pdf->Output($name, 'D');
    }

}

