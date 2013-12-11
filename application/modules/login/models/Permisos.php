<?php

class Login_Model_Permisos {

    protected $_id;
    protected $_idrole;
    protected $_idresource;
    protected $_permission;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Users property');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Users property');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId() {
        return $this->_id;
    }

    public function setIdrole($idrole) {
        $this->_idrole = (int) $idrole;
        return $this;
    }

    public function getIdrole() {
        return $this->_idrole;
    }

    public function setIdresource($idresource) {
        $this->_idresource = (int) $idresource;
        return $this;
    }

    public function getIdresource() {
        return $this->_idresource;
    }

    public function setPermission($permission) {
        $this->_permission = (string) $permission;
        return $this;
    }

    public function getPermission() {
        return $this->_permission;
    }

}

