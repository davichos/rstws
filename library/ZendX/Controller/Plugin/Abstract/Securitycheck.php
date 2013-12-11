<?php

class ZendX_Controller_Plugin_Abstract_Securitycheck extends Zend_Controller_Plugin_Abstract {

    protected $_role;
    protected $_resource;
    private $_controller;
    private $_module;
    private $_action;
    private $_permisos = false;

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $metodoauth = null;
        $this->_controller = $this->getRequest()->getControllerName();
        $this->_module = $this->getRequest()->getModuleName();
        $this->_action = $this->getRequest()->getActionName();
        $resource = $this->_module . '/' . $this->_controller . '/' . $this->_action;
        $metodo = $this->_setMethodauth($this->getRequest());
        switch ($resource) {
            case 'login/index/sign':
                if (!$metodo) {
                    $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                } else {
                    switch ($metodo) {
                        case 'POST':
                            $login = $this->getRequest()->getPost();
                            $data = array('username' => $login['loginN']['username'],
                                'password' => $login['loginN']['password'],
                            );
                            $enty = new Login_Model_Usuarios($data);
                            $mapper = new Login_Model_UsuariosMapper();
                            $creden = $mapper->findAuth($enty);
                            if ($creden !== null) {
                                $creden['pass'] = $login['loginN']['password'];
                                $auth = Zend_Auth::getInstance();
                                $authAdapter = new ZendX_Auth($creden);
                                $adapterAuth = $authAdapter->getAuthadapter();
                                $result = $auth->authenticate($adapterAuth);
                                if ($result->isValid()) {
                                    $storage = new Zend_Auth_Storage_Session();
                                    $storage->write($adapterAuth->getResultRowObject());
                                    switch ($creden['gid']) {
                                        case 1:
                                            $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/home');
                                            break;
                                        case 2:
                                            $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/home/adtivo');
                                            break;
                                        case 3:
                                            $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/home/tecnico');
                                            break;
                                        case 4:
                                            $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/home/comercio');
                                            break;
                                        case 5:
                                            $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/home/medicina');
                                            break;
                                        default :
                                            $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                                            break;
                                    }
                                } else {
                                    $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                                }
                            } else {
                                $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                            }
                            break;
                        default:
                            if (!$this->_isSession()) {
                                $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                            }
                            break;
                    }//fin switch
                }//fin else if
                break;
            case 'login/index/logout':
                $storage = new Zend_Auth_Storage_Session();
                $storage->clear();
                $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                break;

            case 'login/index/route':
                if (!$this->_isSession()) {
                    $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                } else if ($metodo === 'POST') {
                    $request = $this->getRequest()->getPost();
                    $id = $request['choise']['resourcepcs'];
                    $data = array('id' => $id);
                    $comment = new Login_Model_Recursos($data);
                    $mapper = new Login_Model_RecursosMapper();
                    $entries = $mapper->findModule($id, $comment);
                    $resourse = $entries->getResource();
                    $redirects = explode('/', $resourse);
                    $redirect = $redirects[0];
                    if ($resourse === null || $resourse === '')
                        $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login/index/logout');
                    else
                        $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/' . $redirect);
                }
                break;
            case 'default/error/error':
//            case 'default/index/index':
//            case 'default/contacto/index':
//                if (!$this->isUrlValid()) {
//                    $this->_response->setRedirect('http://www.ford.mx/');
//                }
                break;
            case 'redirect/index/index':
            case 'crontask/index/index':
            case 'registro/index/getsuc':
                break;
//            case 'redirect/index/index':
//                break;
            case 'registro/index/index':
            case 'registro/index/register':
            case 'registro/error/index':
            case 'registro/error/tosycond':
            case 'registro/aviso/index':
            case 'registro/aviso/registro':
            case 'registro/error/expired':
            case 'registro/error/agotado':
            case 'registro/error/unico':
            case 'registro/index/exito':
            case 'reportes/master/index':
            case 'reportes/users/index':
            case 'reportes/saldometro/index':
            case 'reportes/visitas/index':
//                var_dump($this->isUrlValid($request));
//                if (!$this->isUrlValid($request)) {
////                    $this->_response->setRedirect('http://www.ford.mx/');
//                }
                break;
            default:
                if (!$this->_isSession()) {
                    if (!($this->_controller === 'index' && $this->_module === 'login' && $this->_action === 'index'))
                        $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                }

                if ($this->_isSession()) {
                    $this->_setRole($this->_getIdrolesession());
                    $this->_setResource($resource);
                    $this->_role = $this->_getRole();
                    $this->_recurso = $this->_getResource();
                    $acl = new ZendX_Acl($this->_role);
                    $this->_permisos = $this->_isAllowed($acl, $this->_role, $this->_recurso);
//                    echo '.';
                }
                if (!$this->_permisos) {
                    if (!($this->_controller === 'index' && $this->_module === 'login' && $this->_action === 'index')) {
                        $storage = new Zend_Auth_Storage_Session();
                        $storage->clear();
                        $this->_response->setRedirect($this->getRequest()->getBaseUrl() . '/login');
                    }
                }
                break;
        }//fin switch
    }

    private function isUrlValid($request) {
        $valid = false;
        var_dump($_SERVER);
        if (key_exists('from', $_SERVER)) {
            $host = $_SERVER['from'];
            if ($host !== null) {
                if (strcasecmp($host, '/ola.html') >= 0 ||
                        strcasecmp($host, 'wwwedu.dragonfly.ford.com') >= 0 ||
                        strcasecmp($host, 'ford.mx') >= 0
//                        || strcasecmp($host, 'http://wwwedu.dragonfly.ford.com/?sitetype=mob&site=FMX') >= 0
//                        || strcasecmp($host, 'http://wwwedu.dragonfly.ford.com/?sitetype=smob&site=FMX') >= 0
                ) {
                    $valid = true;
                }
                if (strripos($host, '/registro?token=') > 0) {
                    $valid = true;
                }
            }
        }
//        return true;
        return $valid;
    }

//fin presipatch

    private function _setMethodauth($request) {
        $metodoauth = false;
        if ($request->isDelete()) {
            $metodoauth = 'DELETE';
        }
        if ($request->isFlashRequest()) {
            $metodoauth = 'FLASHREQUEST';
        }
        if ($request->isGet()) {
            $metodoauth = 'GET';
        }
        if ($request->isHead()) {
            $metodoauth = 'HEAD';
        }
        if ($request->isOptions()) {
            $metodoauth = 'OPTIONS';
        }
        if ($request->isPost()) {
            $metodoauth = 'POST';
        }
        if ($request->isPut()) {
            $metodoauth = 'PUT';
        }
        if ($request->isSecure()) {
            $metodoauth = 'HTTPS';
        }
        if ($request->isXmlHttpRequest()) {
            $metodoauth = 'XHR';
        }

        return $metodoauth;
    }

    private function _isSession() {
        $isSession = false;
        $storage = new Zend_Auth_Storage_Session();
        $data = $storage->read();
//        var_dump($data);
        if ($data !== null)
            $isSession = true;
        return $isSession;
    }

    public function _getIdrolesession() {
        $storage = new Zend_Auth_Storage_Session();
        $data = $storage->read();
        return $data->id_perfil;
    }

    private function _isAllowed($acl, $role, $resource) {
//        var_dump($acl);
//        var_dump($role);
//        var_dump($resource);
        $permiso = ($acl->isAllowed($role, $resource) ? true : false);
        return $permiso;
    }

    private function _getRole() {
        return $this->_role;
    }

    private function _setRole($role) {
        $this->_role = $role;
    }

    private function _getResource() {
        return $this->_resource;
    }

    private function _setResource($resource) {
        $entidades = new Login_Model_Recursos(array('resource' => $resource));
        $mapper = new Login_Model_RecursosMapper();
        $id_resource = $mapper->findResource($entidades);
        if (!empty($id_resource)) {
            $this->_resource = $id_resource[0]->id;
        }
    }

}