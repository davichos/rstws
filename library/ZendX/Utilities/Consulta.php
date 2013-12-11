<?php

class ZendX_Utilities_Consulta extends ZendX_Utilities_Bd {

    public function getConsultaFiltros($arreglo, $limit = 1000) {
        $select = null;
        if (!empty($arreglo) && $this->getBd() !== null) {
            $select = $this->getBd()->getDbTable()->select();
            foreach ($arreglo as $key => $item) {
                if ($item !== '') {
                    $item = $this->getValueToId($key, $item);
                    $select->where($key . ' like(?)', '%' . $item . '%');
                }
            }
        }
        if (null !== $select) {
            $select->limit($limit, 0);
        }
        return $select;
    }

    public function getConsultaFiltrosOr($arreglo) {
        $select = null;
        if (!empty($arreglo) && $this->getBd() !== null) {
            $select = $this->getBd()->getDbTable()->select();
            foreach ($arreglo as $key => $item) {
                if ($item !== '') {
                    switch ($key) {
                        case 'no_vendedor':
                        case 'numero_cliente':
                            $users = explode("\n", $item);
                            foreach ($users as $user) {
                                $item = $this->getValueToId($key, $user);
                                $select->orwhere($key . '=?', $user);
                            }
                            break;
                        default:
                            $item = $this->getValueToId($key, $item);
                            $select->where($key . '=?', $item);
                            break;
                    }
                }
            }
        }

        return $select;
    }

    public function getPaginas($estado, $limit) {
        $select = $this->getBd()->getDbTable()->select()
                ->where('estado =?', $estado);
        $result = $this->getBd()->getDbTable()->fetchAll($select);
        $paginas = (int) (count($result) / $limit) + 1;
        $item = $paginas;
        return $item;
    }

    public function findId($id, $keysubform, $pkName) {

        if ($this->getBd() !== null) {
            $items = null;
            $select = $this->getBd()->getDbTable()
                    ->select()
                    ->where($pkName . '=?', $id);
            $result = $this->getBd()->getDbTable()->fetchRow($select);
            if ($result !== null) {
                $items = array();
                foreach ($keysubform as $enty) {
                    foreach ($result->toArray() as $key => $item) {
                        $newkey = preg_replace('/_/', '', $key);
                        $item = $this->getIdToValue($key, $item);
                        $items[$enty . '-' . $newkey] = $item;
                    }
                }
            }
            return $items;
        }
    }

    private function getValueToId($key, $value) {
        switch ($key) {
            case 'id_vendedor':
                $mv = new Ccm_Model_ModvendedoresMapper();
                $value = $mv->getVendedorToId($value);
                break;
            case 'id_cliente':
//                $mv = new Ccm_Model_ModclientesMapper();
//                $value = $mv->getClienteToId($value);
                break;
            case 'fecha':
                $date = new Zend_Date($value);
                $value = $date->getTimestamp();
                break;
//            case 'estatus':
//                $temp=-1;
//                if (strtolower($value) === 'activo')
//                    $temp = 1;
//                $value=$temp;
//                break;
        }
        return $value;
    }

    private function getIdToValue($key, $value) {
        switch ($key) {
            case 'fecha_nacimiento':
                $value = ZendX_Utilities_Date::getDate($value,'yyyy-MM-dd');
                break;
        }
        return $value;
    }

}
