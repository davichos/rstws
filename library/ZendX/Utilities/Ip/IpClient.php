<?php

/**
 * 
 * Utility to get the real IP Address of the client
 * @package Utilities
 * @subpackage Ip
 * @author David Gomez
 */
class ZendX_Utilities_Ip_IpClient {

    /**
     * @method __construct()
     * @access public
     * @author David Gomez
     */


     /**
     * @method getRealIp()
     * @access public
     * @return string IPAddress
     * @author David Gomez
     */
    public function getRealIP() {
        if ( !empty( $_SERVER[ 'HTTP_CLIENT_IP' ] ) )
            return $_SERVER[ 'HTTP_CLIENT_IP' ];

        if ( !empty( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) )
            return $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];

        return $_SERVER[ 'REMOTE_ADDR' ];
    }

}

