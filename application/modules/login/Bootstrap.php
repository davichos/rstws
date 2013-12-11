<?php
class Login_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initViewHelpers()
    {
		$view = new Zend_View(); 
		$view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper'); 
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer(); 
		$viewRenderer->setView($view); 
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
	}
}