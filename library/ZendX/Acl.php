<?php

class ZendX_Acl extends Zend_Acl {

    /**
     * __construct
     *  
     */
    public function __construct($role) {
        $this->addRoles();
        $inhRole = $role;
        $this->addRecurso($inhRole);
        $this->addPermisos($inhRole);
    }

    /**
     *  Agrega Roles Padre para ACL
     *  
     */
    public function addRoles() {
        $mapper = new Login_Model_RolesMapper();
        $entidades = $mapper->rolesParent();
        foreach ($entidades as $row) {
            $rol = $row->id;
            $idparent = $row->idparent;
            if ($idparent === 0) {
                $this->addRole(new Zend_Acl_Role($rol), null);
            } else {
                $this->addRole(new Zend_Acl_Role($rol), new Zend_Acl_Role($idparent));
            }
        }
    }

    /**
     * Agregar un recurso
     * 
     */
    public function addRecurso($role) {
        $isResource = false;
        $tipear = new Login_Model_Recursos(array('id' => $role));
        $mapper = new Login_Model_RecursosMapper();
        $entidades = $mapper->recursosParent($tipear);
        foreach ($entidades as $row) {
            $recurso = $row->id;
            $iddparent = $row->idparent;
            if ($recurso !== null)
                $isResource = true;
            if ($isResource) {
                if ($iddparent === 0) {
                    $this->addResource(new Zend_Acl_Resource($recurso), null);
                } else {
                    $this->addResource(new Zend_Acl_Resource($recurso), new Zend_Acl_Resource($iddparent));
                }
            }
        }
    }

    /**
     * Agrega Permisos
     * 
     */
    public function addPermisos($role) {
        $isPermiso = false;
        $permisos = array();
        $recursos = array();
        $tipear = new Login_Model_Permisos(array('idrole' => $role));
        $mapper = new Login_Model_PermisosMapper();
        $entidades = $mapper->loadPermiso($tipear);
        $permisos['idrole'] = $role;
        foreach ($entidades as $row) {
            $recurso = $row->idresource;
            if ($recurso !== null)
                $isResource = true;
            if ($isResource) {
                switch ($row->permission) {
                    case 'deny':
                        $permisos['deny'][] = $recurso;
                        break;
                    case 'allow':
                        $permisos['allow'][] = $recurso;
                        break;
                }
            }
        }
        if (isset($permisos['deny'])) {
            $this->deny($permisos['idrole'], $permisos['deny']);
        }
        if (isset($permisos['allow'])) {
            $this->allow($permisos['idrole'], $permisos['allow']);
        }
    }

}
