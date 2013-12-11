<?php

class ZendX_Auth {

    protected $_salt;
    protected $_authadapter;
    protected $_cript;

    public function __construct($credencial = null) {
        if ($credencial !== null) {
//            $this->_setSalt($credencial['passwordcrypt']);
            $passcrypt = $this->_setCryptpass($credencial['pass']);
            $users = new Login_Model_DbTable_Usuarios();
            $authAdapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(), 'mod_users');
            $authAdapter->setIdentityColumn('username')
                    ->setCredentialColumn('password');
            $authAdapter->setIdentity($credencial['username'])
                    ->setCredential($passcrypt);

            $this->_authadapter = $authAdapter;
        }
    }

    private function _setCryptpass($credential) {
//        $salt = $this->_salt;
//        $password = $credential;
//        $passDecode = md5($password . $salt);
//        $passEncode = $passDecode . ":" . $salt;
//        $this->_cript = $passDecode;
//        return $passEncode;
//        echo ZendX_Utilities_AdSecurityCheck::crypt('4dm1n');
        return ZendX_Utilities_AdSecurityCheck::crypt($credential);
    }

    private function _setSalt($passcrypt = false) {
        if ($passcrypt) {
//            $pass = explode(':', $passcrypt);
//            $this->_salt = $pass[1];
        }
    }

    public function getAuthadapter() {
        return $this->_authadapter;
    }

    public function setPassword($password) {
//        $salt = $this->_mosMakePassword(16);
//        $passDecode = md5($password . $salt);
//        $passEncode = $passDecode . ":" . $salt;
//        $this->_cript = $passDecode;
        return ZendX_Utilities_AdSecurityCheck::crypt($password);
    }

    public function setGenpassword() {
        $pass = $this->_mosMakePassword(4);
        return $pass;
    }

    protected function _mosMakePassword($length = 8) {
        $salt = "SAMCANASAM776633554488cdxfghkmnpqrstwxzABCDXFGHKMNPQRSTWXZ23456789";
        $makepass = '';
        mt_srand(10000000 * (double) microtime());
        for ($i = 0; $i < $length; $i++)
            $makepass .= $salt[mt_rand(0, 45)];
        return $makepass;
    }

    public function getCript() {
        return $this->_cript;
    }

}