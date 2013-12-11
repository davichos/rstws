<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreaFilePDF
 *
 * @author DGomez
 */
class ZendX_pdf_CreaFilePDF extends ZendX_pdf_FilePDF {

    private $_w;
    private $_data;

    public function setData($data) {

        $this->_data = $data;
    }

    private function calculateSizeColumns() {
        foreach ($this->getData() as $value) {
            $i = 0;
            foreach ($value as $val) {
                $num = strlen($val) * 2;
                if ($num > $this->_w[$i]) {
                    $this->_w[$i] = $num;
                }
                $i++;
            }
        }
    }

    public function getData() {
        return $this->_data;
    }

// Tabla coloreada
    public function FancyTable() {
        //obtener los valores del encabezado
        $data = $this->getData();
        $header = array_shift($data);
        // Colores, ancho de línea y fuente en negrita

        $this->SetFillColor(0, 102, 204);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 102, 204);
        $this->SetLineWidth(.2);
        $this->SetFont('', 'B');
        $this->calculateSizeColumns();
        
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($this->_w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();

        // Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        $fill = false;
        foreach ($data as $rows) {
            $i = 0;
            foreach ($rows as $row) {
                $this->Cell($this->_w[$i], 3, $row, 'LR', 0, 'L', $fill);
                $i++;
            }
            $this->Ln();
            $fill = !$fill;
        }
    }

}

