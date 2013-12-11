<?php

/**
 * Clase de ayuda para comprobar la firma de excel y asignarle su metadata correspondiente
 * @package Utilities
 * @access public
 * @author David Gomez
 */
class ZendX_Utilities_CompruebaFirma {

    /**
     *
     * @param int $numberXSD
     * @return array|null tabla de metadatos
     */
    public function comprueba($numberXSD) {
        $table = null;
        switch ($numberXSD) {
            case 1:
                $t = new Application_Model_TestexcelMapper();
                $table = $t->getMetadata()->info();
                break;
            case 2:
                $t = new Application_Model_FaltasEmpleadoMapper();
                $table = $t->getMetadata()->info();
                break;
            case 4:
                $t = new Application_Model_CedisMapper();
                $table = $t->getMetadata()->info();
                break;
            case 6:
                $t = new Application_Model_EmpleadosMapper();
                $table = $t->getMetadata()->info();
                break;
            default :
        }//fin swirch
        return $table;
    }

}

