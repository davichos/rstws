<?php
class ZendX_Auth_Method_Soap_Storage{
	
	protected $_idsession;
	
	public function __construct($credencial,$obj)
	{
//		if($credencial['isAuth']){
//			$storage = new Zend_Auth_Storage_Session();
//			$storage->write($obj);
//			$token	= sha1(uniqid('',true));
//			$id = Zend_Session::getId();
//			$data = array(
//						'id'=>$token,
//						'idsession'=>$id,
//						'user'=>$credencial['username'],
//						'pass'=>$credencial['password']
//			);
//			$tipear = new Login_Model_Sessionsoap($data);
//			$mapper = new Login_Model_SessionsoapMapper();
//			$mapper->save($tipear);
//			$this->_idsession=$token;
//			
//			$storage->clear();
//		}	
		
				
								
				
	}
	
	public function getIdstore()
	{
		return $this->_idsession;
	}
}