<?php

class ZendX_Wsdl_Api_Urrea_Ticket {

    /**
     * 
     * @param string $params
     * @return string
     */
    public static function setTicket($params) {
        if (null !== $params) {
            $info = self::_getArray($params);
            $ticketMappr = new Wsdl_Model_ModticketMapper();
            /* arreglo de retorno */
            $clienteObj = new Wsdl_Model_Modticket($info);
            $return = $ticketMappr->write($clienteObj);
            return ZendX_Utilities_SecurityWSCheck::crypt(json_encode($return));
        }
        throw new Exception('Usuario inexistente', '10', '');
    }

    /**
     * 
     * @param string $params
     * @return string
     */
    private static function _getArray($params) {
        $jsonParser = new ZendX_Action_Helper_Jsontoarray();
        $datos = ZendX_Utilities_SecurityWSCheck::decrypt($params);
        return $jsonParser->setJsontoarray($datos);
    }

}