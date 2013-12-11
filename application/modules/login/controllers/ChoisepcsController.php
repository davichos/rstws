<?php

class Login_ChoisepcsController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        //$this->_helper->viewRenderer->setNoRender ();
        //$this->_helper->getHelper ( 'layout' )->disableLayout();
    }

    public function indexAction() {
        // action body
        $storage = new Zend_Auth_Storage_Session();
        $data = $storage->read();
        $idrole = (int) $data->gid;
        $comment = new Login_Model_Permisos(array('idrole' => $idrole));
        $mapper = new Login_Model_PermisosMapper();
        $entries = $mapper->listaRouter($comment);

        $cantmodulo = 0;
        foreach ($entries as $item) {
            if ($item->idparent === 0)
                ++$cantmodulo;
        }

        if ($cantmodulo > 1) {
            $rows = array();

            $formchoise = new Login_Form_Choisepcs();
            $formchoise->setAttribs(
                    array(
                        'name' => 'login',
                        'method' => 'post',
                        'action' => $this->getRequest()->getBaseUrl() . '/login/index/route',
                    )
            );

            $form = $formchoise->getSubForms();
            $subform = $form['choise'];
            $elements = $subform->getElements();
            $elements['resourcepcs']->dijitParams['store']['params']['url'] = $this->getRequest()->getBaseUrl() . '/login/choisepcs/listapcs';
            $this->view->formchoise = $formchoise;
            $this->view->Dojo()
                    ->addStylesheet($this->getRequest()->getBaseUrl() . '/css/usuarios.css');
        } else {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->getHelper('layout')->disableLayout();
            foreach ($entries as $toredirects) {
                if ($toredirects->resource !== 'login')
                    $toredirect = $toredirects->resource;
            }
            $redirects = explode('/', $toredirect);
            $this->_redirect('/' . $redirects[0]);
        }
    }

    public function listapcsAction() {
        // action body
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
        $rows = array();
        $this->getResponse()
                ->setHeader('Content-Type', 'application/json; charset=utf-8');
        $storage = new Zend_Auth_Storage_Session();
        $data = $storage->read();
        $comment = new Login_Model_Permisos(array('idrole' => $data->gid));
        $mapper = new Login_Model_PermisosMapper();
        $entries = $mapper->listaRouter($comment);

        Zend_Json::$useBuiltinEncoderDecoder = true;

        foreach ($entries as $item) { //id de parent 0 modulos 	
            if ($item->idparent === 0) {
                array_push($rows, array(
                    'name' => $item->nombre,
                    'label' => $item->nombre,
                    'id' => $item->id,
                        )
                );
            }
        }
        $jsonData = Zend_Json::encode(
                        array('identifier' => 'id',
                            'items' => $rows));
        $this->getResponse()->setBody($jsonData);
    }

}
