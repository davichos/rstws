<?php

class ZendX_Wsdl_Api {

    /**
     * Retorna los clientes asociados al vendedor
     * 
     * @param string $param1
     * @param string $param2
     * @return string
     */
    public function canLogin($param1, $param2) {
        return ZendX_Wsdl_Api_Urrea_Clientes::getClienteInfo($param1, $param2);
    }

    /**
     * Retorna los tickets asociados al cliente
     * 
     * @param string $param1
     * @return string
     */
    public function getEdoCta($param1) {
        return ZendX_Wsdl_Api_Urrea_Edocta::getEdoCta($param1);
    }

    /**
     * Retorna los tickets asociados al cliente
     * 
     * @param string $param1
     * @return string
     */
    public function getPedidos($param1) {
        return ZendX_Wsdl_Api_Urrea_Pedidos::getPedidos($param1);
    }

    /**
     * Retorna los tickets asociados al cliente
     * 
     * @param string $params
     * @return string
     */
    public function setPedidos($params) {
        return ZendX_Wsdl_Api_Urrea_Pedidos::setPedidos($params);
    }

    /**
     * Retorna los tickets asociados al cliente
     * 
     * @param string $params
     * @return string
     */
    public function setCliente($params) {
        return ZendX_Wsdl_Api_Urrea_Clientes::createClient($params);
    }

    /**
     * Retorna los tickets asociados al cliente
     * 
     * @param string $params
     * @return string
     */
    public function setTicket($params) {
        return ZendX_Wsdl_Api_Urrea_Ticket::setTicket($params);
    }

    /**
     * Retorna listado de estados
     * 
     * @return string
     */
    public function getEstados() {
        return ZendX_Wsdl_Api_Urrea_Distribuidores::getEstados();
    }

    /**
     * Retorna listado de ciudades de según el parámetro
     * 
     * @param string $param Parámetros
     * @return string
     */
    public function getCiudades($param) {
        return ZendX_Wsdl_Api_Urrea_Distribuidores::getCiudades($param);
    }

    /**
     * Retorna listado de direcciones según los parámetros
     * 
     * @param string $param1 Parámetros
     * @param string $param2 Parámetros
     * @return string
     */
    public function getDireccion($param1, $param2) {
        return ZendX_Wsdl_Api_Urrea_Distribuidores::getDirecciones($param1, $param2);
    }

}
