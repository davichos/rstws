<?php

class ZendX_Utilities_Mail_BuidViewMail extends Zend_Controller_Action_Helper_Abstract {

    public static function getNotificationAdmin($clientename, $filename) {
        return '<p><b>Estimado Usuario</b></p><br/>
            <p>El cliente <b>' . $clientename . '</b> ha cargado un nuevo Ticket al sitio urreamespatrio.com</p><br/>
            <p>Puedes descargarlo dándo clic <a href="' . $filename . '">aqu&iacute;</a></p><br/>
            <p>Para procesar el ticket no olvides entrar al <a href="http://admp.urreamespatrio.com">módulo de administración</a></p>
            <br/><br/><br/>
            <p>Saludos</p>';
    }

}