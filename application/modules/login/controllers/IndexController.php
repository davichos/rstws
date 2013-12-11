<?php

class Login_IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
        $formlogin = new Login_Form_Login();
        $this->view->formlogin = $formlogin;
        $this->view->Dojo()
                ->addStylesheet($this->getRequest()->getBaseUrl() . '/css/usuarios.css');
    }

    public function signAction() {
        // action body
    }

    public function logoutAction() {
        // action body
    }

    public function routeAction() {
        // action body
    }

}

