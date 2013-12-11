<?php
class ZendX_Action_Helper_Gerentecoo_Download_Periodo extends Zend_Controller_Action_Helper_Abstract
{
	protected $_periodos;
	
	public function getFechaISO()
	{
		date_default_timezone_set('America/Mexico_City');
		$fechas=array();
		$periodo =false;
		$fecha =  new Zend_Date();
		$fechaunix = $fecha->getTimestamp();
		
		$this->_setPeriodos();
		foreach ($this->_periodos as $item){			
			if($fechaunix>=strtotime($item->inicia)&&$fechaunix<=strtotime($item->finaliza))$periodo=$item->id;
		}
		return $periodo;
		
	}
	
	private function _setPeriodos()
	{
		$mapper			= new Cnv_Model_EstarcperMapper();
		$periodos		= $mapper->readEstarcper();
		$this->_periodos= $periodos;
	}
	
	
	
}