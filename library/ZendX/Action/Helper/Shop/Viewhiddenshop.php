<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ZendX_Action_Helper_Shop_Viewhiddenshop extends Zend_Controller_Action_Helper_Abstract{
	
	public function setModulos($modulos,$role){
		$allowed = false;
		$tipear	  = new Login_Model_Permisos(array('idrole'=>$role));
		$permisos = new Login_Model_PermisosMapper();		
		$recurso  = $permisos->viewBulid($tipear,$modulos);
		if(isset($recurso['permiso'])){
			if($recurso['permiso']==='allow') $allowed = true;
		}
		
		return $allowed;		
	}
	
}
