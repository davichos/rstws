<?php
class ZendX_Action_Helper_Viewhidden extends Zend_Controller_Action_Helper_Abstract{
	
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