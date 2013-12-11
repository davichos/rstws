<?php

class ZendX_Action_Helper_Jsontoarray extends Zend_Controller_Action_Helper_Abstract {

    protected $_toarray;

    public function preDispatch() {
        
    }

    public function setJsontoarray($request) {
        $array = array();
        try {
            Zend_Json::$useBuiltinEncoderDecoder = true;
            $phpNative = Zend_Json::decode($request);
            $this->_setToarray($phpNative);
            $array = $this->_toarray;
        } catch (Exception $e) {
            $array = $this->_toArray($request);
        }
        return $array;
    }

    private function _toArray($request) {
        $array = array();
        try {
            $requestBody = str_replace('\'', '', 
                    str_replace('}', '', str_replace('{', '', $request)));
            $a = (explode(',', $requestBody));
            foreach ($a as $value) {
                $b = (explode(':', $value));
                $i = 0;
                foreach ($b as $value) {
                    if ($i === 0) {
                        $k = $value;
                        $i = 1;
                    } else {
                        $array[$k] = $value;
                    }
                }
            }
        } catch (Exception $e) {
            
        }
        return $array;
    }

    private function _setToarray($jsontoarray) {

        $permissions = array();

        foreach ($jsontoarray as $key => $items) {
            if ($newkey = $this->_getKeyarray($key)) {
                $permissions[$newkey] = $items;
            } else {
                $permissions[$key] = $items;
            }
        }
        $this->_toarray = $permissions;
    }

    private function _getKeyarray($keys = null) {
        if ($keys !== null && preg_match('/\[/', $keys, $coincidencias) > 0) {
            $a = explode('[', $keys);
            $b = explode(']', $a[1]);
            $key = $b[0];
        } else {
            $key = false;
        }
        return $key;
    }

    public function getTimeStamp($date) {
        date_default_timezone_set('America/Mexico_City');
        $fechaingreso = new Zend_Date($date);
        return $fechaingreso->getTimestamp();
    }

}
