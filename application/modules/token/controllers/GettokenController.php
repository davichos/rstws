<?php

/**
 * Regular controller
 * */
class Token_GettokenController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->_helper->viewRenderer->setNoRender();
    }

    public function indexAction() {
        $request = $this->getRequest();
        $array['token'] = false;
        if ($request->isPost()) {
            $requestBody = $request->getRawBody();
            $json2array = $this->_helper->getHelper('Jsontoarray');
            $arreglo = $json2array->setJsontoarray($requestBody);
            $login = new ZendX_Auth_Method_Authenticate();
            $ses = $login->login($arreglo['username'], $arreglo['password']);
            if ($ses['isAuth']) {
                $array['token'] = ZendX_Utilities_SecurityWSCheck::generateToken();
            }
        }
        $this->getResponse()
                ->setHeader('Content-Type', 'application/json; charset=utf-8');
        $this->getResponse()->setBody(json_encode($array));
    }

}
