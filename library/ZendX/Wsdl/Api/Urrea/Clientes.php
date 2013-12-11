<?php

class ZendX_Wsdl_Api_Urrea_Clientes {

    /**
     * 
     * Funcion que permite comprobar que exista el usuario y contraseña
     * 
     * @param string $usernane
     * @param string $psw
     * @return string
     */
    public static function getClienteInfo($usernane, $psw) {
        /* arreglo de retorno */
        date_default_timezone_set('America/Mexico_City');
        $array = array('login' => false);

        /* verificar que los datos de logueo sean verdaderos */
        $clientesMapper = new Wsdl_Model_ModclientesMapper();
        /* si el cliente existe y se puede loguear */
        $info = $clientesMapper->canLogin($usernane, $psw);
        if ($info !== null) {
            /* empezando a armar el array respuesta */
            $array = array('login' => true);
            /* obtener estado de cuenta */
            $puntosM = new Wsdl_Model_ModpuntosMapper();
            $array['info'] = $info;
            $array['puntos'] = $puntosM->getPuntosDisponibles($info['id']);
        }
        /* retornar valores del arreglo */
        return ZendX_Utilities_SecurityWSCheck::crypt(json_encode($array));
    }

    /**
     * 
     * @param string $params
     * @return string
     */
    public static function createClient($params) {
        if (null !== $params) {
            $info = self::_getArray($params);
            $clientesMappr = new Wsdl_Model_ModclientesMapper();

            /* arreglo de retorno */
            $clienteObj = new Wsdl_Model_Modclientes($info);
            $return = $clientesMappr->write($clienteObj);
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