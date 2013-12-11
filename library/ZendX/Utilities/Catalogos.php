<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogos
 *
 * @author DGomez
 */
class ZendX_Utilities_Catalogos extends ZendX_Utilities_Bd implements ZendX_Utilities_Interfaces_AsignaBd {

    //put your code here

    public function asignModel($id) {
        var_dump($id);
        switch (strtolower($id)) {
            case 'status':
            case 'estatus':
                $this->setBd('estatus');
                break;
        }
    }

    public function getMetadata() {
        if (null !== $this->getBd())
            return $this->getBd()->getMetadata();
        else
            return null;
    }

    public function save(array $data) {
        if (null !== $this->getBd()) {
            if (!$this->getBd() instanceof Cnv_Model_EstarcperMapper)
                return $this->getBd()->write($data);
            else {
                return 5;
            }
        }
    }

    public function find($key = '', $value = '') {
        $return = $value;
        switch ($key) {
            case 'status':
            case 'estatus':
                switch (strtolower($value)) {
                    case 'error':
                        $return = -1;
                        break;
                    case 'por validar':
                        $return = 0;
                        break;
                    case 'en espera':
                        $return = 1;
                        break;
                    case 'validado':
                        $return = 2;
                        break;
                    default :
                        $return = 0;
                        break;
                }
                break;
            case 'fecha_fac':
            case 'fecha_last':
            case 'fecha_act':
                if (strpos($value, ':') > 1)
                    $return = str_replace(' ', 'T', $value);
                else
                    $return = $value.'T00:00:00';
                break;
        }
        return $return;
    }

}

