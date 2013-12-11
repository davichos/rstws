<?php

class ZendX_Utilities_Date extends ZendX_Utilities_Bd {

    public static function getCurrentTimestamp($time = null) {
        date_default_timezone_set('America/Mexico_City');
        $date = new Zend_Date($time);
        return $date->getTimestamp();
    }

    public static function getDate($time = null,$format='dd/MM/yyyy') {
        date_default_timezone_set('America/Mexico_City');
        if ($time !== null) {
            if ((int) $time !== 0) {
                $date = new Zend_Date($time);
                return $date->toString($format);
            }
        }
        return 'N/D';
    }

}
