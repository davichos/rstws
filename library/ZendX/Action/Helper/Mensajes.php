<?php
class ZendX_Action_Helper_Mensajes extends Zend_Controller_Action_Helper_Abstract{
	
	protected $_nomensajes;
	
	public function setNomensajes($id){
		$countMensajes = new Cnv_Model_BandejaMapper();
		$this->_nomensajes = $countMensajes->countMensajes($id);
	}
	public function getNomensajes(){
		return $this->_nomensajes;
	}
}