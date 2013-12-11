<?php

class ZendX_Action_Helper_Sign extends Zend_Controller_Action_Helper_Abstract {

    protected $_param;

    public function setParam($param) {
        $this->_param = $param;
    }

    public function getParam() {
        $uniqid = uniqid('', true);
        $data = '|' . $this->_param['idtemplate'] .
                '|' . $uniqid;

        $binary = Zend_Crypt_Hmac::compute(
                        $this->_getKey(), 'SHA1', $data, Zend_Crypt_Hmac::BINARY
        );
        $session = new Zend_Auth_Storage_Session();
        $id = $session->read();
        $ips = new Zend_Controller_Request_Http();
        $ip = sprintf('%u', ip2long($ips->getClientIp(true)));
        date_default_timezone_set('America/Mexico_City');
        $datedown = new Zend_Date();
        $this->_param['firma'] = base64_encode($binary);
        $this->_param['nombrearchivo'] = $uniqid . '.xlsx';
        $this->_param['nombresellado'] = $uniqid;
        $this->_param['ip'] = $ip;
        $this->_param['estado'] = 1;
        $this->_param['accion'] = '0';
        $this->_param['fechadescargado'] = $datedown->getTimestamp();
        $this->_param['fechacargado'] = 0;
        $this->_param['fechaporcesado'] = 0;
        $this->_param['idusername'] = $id->id;


        return $this->_param;
    }

    static function _getKey() {
        $key = '2J{nH^qCH:[9hEPagb';
        return $key;
    }

}