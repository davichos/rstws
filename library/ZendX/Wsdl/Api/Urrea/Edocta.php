<?php

class ZendX_Wsdl_Api_Urrea_Edocta {

    /**
     * 
     * Funcion que permite comprobar que exista el usuario y contraseña
     * 
     * @param type $idCliente
     * @param type $psw
     * @return type
     */
    public static function getEdoCta($idCliente) {
        /* arreglo de retorno */
        if (null !== $idCliente || $idCliente !== 0) {
            $clientesMapper = new Wsdl_Model_ModticketMapper();
            $ticket['tickets'] = $clientesMapper->getTickets($idCliente);
            $pts = new Wsdl_Model_ModpuntosMapper();
            $ticket['disponibles'] = $pts->getPuntosDisponibles($idCliente);
            return ZendX_Utilities_SecurityWSCheck::crypt(json_encode($ticket));
            /* retornar valores del arreglo */
        }
        throw new Exception('Usuario inexistente', '10', '');
    }

}