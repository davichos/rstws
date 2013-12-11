<?php

class ZendX_Wsdl_Api_Urrea_Distribuidores {

    /**
     * Devuelve el listado de estados
     * 
     * @return string
     */
    public static function getEstados() {
        /* arreglo de retorno */
        $distMapper = new Wsdl_Model_CatdistribuidorMapper();
        $estados = $distMapper->getEstados();
        return ZendX_Utilities_SecurityWSCheck::crypt(json_encode($estados));
    }

    /**
     * 
     * Devuelve el listado de ciudades por estado
     * 
     * @param string $estado     
     * @return string
     */
    public static function getCiudades($estado) {
        /* arreglo de retorno */
        $distMapper = new Wsdl_Model_CatdistribuidorMapper();
        $ciudades = $distMapper->getCiudades($estado);
        return ZendX_Utilities_SecurityWSCheck::crypt(json_encode($ciudades));
    }

    /**
     * 
     * Devuelve el listado de ciudades por estado
     * 
     * @param string $poblacion     
     * @param string $estado     
     * @return string
     */
    public static function getDirecciones($estado, $poblacion) {
        /* arreglo de retorno */
        $distMapper = new Wsdl_Model_CatdistribuidorMapper();
        $ciudades = $distMapper->getDireccion($estado,$poblacion);
        return ZendX_Utilities_SecurityWSCheck::crypt(json_encode($ciudades));
    }

}