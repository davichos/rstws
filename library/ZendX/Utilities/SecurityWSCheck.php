<?php

/**
 * Ayuda para modificar el valor del XML
 * @package Utilities
 * @author David Gomez
 */
class ZendX_Utilities_SecurityWSCheck {

    /**
     *
     * @param int $idCola
     * @param int $estado
     * @param ZendX_Actions_Helper_FTPConection $helperFTP
     * @return string 
     */
    public static function isValid($data) {
        $return = false;
        try {
            if (null !== $data && !empty($data)) {
                $decrypt = self::compusamcrypt(str_replace(' ', '+', $data), "D");
                $data = Zend_Serializer::unserialize($decrypt);
                foreach ($data as $key => $value) {
                    if ($value === "com.adbox.mobile") {
                        $return = true;
                        break;
                    }
                }
            }
        } catch (Exception $e) {
            
        }
        return $return;
    }

    public static function generateToken() {
        $date = new Zend_Date();
        $token = array('from' => 'com.adbox.mobile',
            't' => $date->getTimestamp(),
        );
        return self::crypt(serialize($token));
    }

    public static function decrypt($data) {
        return self::compusamcrypt($data, "D");
    }

    public static function crypt($data) {
        return self::compusamcrypt($data, "E");
    }

    private static function compusamcrypt($text, $action) {
        $key = 'i|0Xt:@3M/e¬Si^{R}%J5?-';
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
