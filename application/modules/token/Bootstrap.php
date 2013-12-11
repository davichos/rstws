<?php

class Token_Bootstrap extends Zend_Application_Module_Bootstrap {

    public function _init() {
        
    }

    protected function _initJsontoarray() {
        Zend_Controller_Action_HelperBroker::addHelper(
                new ZendX_Action_Helper_Jsontoarray
        );
    }

}
