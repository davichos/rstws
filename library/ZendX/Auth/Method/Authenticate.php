<?php

class ZendX_Auth_Method_Authenticate {

    /**
     * Retorna true si son validas la credenciales
     * 
     * @param string $user
     * @param string $pass
     * @return array
     */
    public function login($user = '', $pass = '') {
        $sess['isAuth'] = false;
        $data = array('username' => $user,
            'password' => $pass,
        );
        $enty = new Login_Model_Usuarios($data);
        $mapper = new Login_Model_UsuariosMapper();
        $creden = $mapper->findAuth($enty);
        if ($creden !== null) {
            $creden['pass'] = $pass;

            $auth = Zend_Auth::getInstance();
            $authAdapter = new ZendX_Auth($creden);
            $adapterAuth = $authAdapter->getAuthadapter();
            $result = $auth->authenticate($adapterAuth);
            $sess['isAuth'] = $result->isValid();
            $data['isAuth'] = $sess['isAuth'];
            if ($result->isValid()) {
                $storage = new ZendX_Auth_Method_Soap_Storage(
                        $data, $adapterAuth->getResultRowObject()
                );
                $request = new Zend_Controller_Request_Http();
                $sess['token'] = 'http://' . $request->getHttpHost() . $request->getBaseUrl() . '/login/index/sign/token/' . $storage->getIdstore();
            }
        }
        return $sess;
    }

    /**
     * Retorna array de puestos
     * 
     * @return array
     */
    public function getPuestos() {
        $mapper = new Cnv_Model_CatpuestoMapper();
        $result = $mapper->read();
        return $result;
    }

}
