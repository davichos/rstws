<?php

/**
 * Ayuda para modificar el valor del XML
 * @package Utilities
 * @author David Gomez
 */
class ZendX_Utilities_AdSecurityCheck {

    /**
     *
     * @param int $idCola
     * @param int $estado
     * @param ZendX_Actions_Helper_FTPConection $helperFTP
     * @return string 
     */
    public static function isValid($data) {
        $decrypt = self::compusamcrypt($data, "D");
        $data = unserialize($decrypt);
        $return = false;
        foreach ($data as $key => $value) {
            if ($value === "http://programaatusalud.com/") {
                $return = true;
                break;
            }
        }
        return $return;
    }

    public static function decrypt($data) {
        return self::compusamcrypt($data, "D");
    }

    public static function crypt($data) {
        return self::compusamcrypt($data, "E");
    }

    private static function compusamcrypt($text, $action) {
        $key = '4b>=|>@iTw|~$gu*+8De';
        if ($action == "E") {
            $reg = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $text, MCRYPT_MODE_CBC, md5(md5($key))));
        }
        if ($action == "D") {
            $reg = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($text), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        }

        return $reg;
    }

//Uso
}

