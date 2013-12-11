<?php

/**
 * Class to read file excel by parts
 * @package Excel
 * @subpackage ReadExcel
 * @author David Gomez
 */
class ZendX_Excel_ReadExcel_ChunkReadFilter implements PHPExcel_Reader_IReadFilter {

    /**
     *
     * @var int
     */
    private $_startRow = 0;
    
    /**
     *
     * @var int
     */
    private $_endRow = 0;

    /**
     * Set the list of rows that we want to read 
     * @param int $startRow
     * @param int $chunkSize 
     */
    public function setRows( $startRow, $chunkSize ) {
        $this -> _startRow = $startRow;
        $this -> _endRow = $startRow + $chunkSize;
    }
    
    /**
     *
     * @param string $column excel column
     * @param int $row excel row
     * @param string $worksheetName excel worksheet
     * @return boolean
     */
    public function readCell( $column, $row, $worksheetName = '' ) {
        if ( ( $row == 1 ) || ( $row >= $this -> _startRow && $row < $this -> _endRow ) ) {
            return true;
        }
        return false;
    }

}