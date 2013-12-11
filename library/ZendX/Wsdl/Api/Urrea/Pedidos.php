<?php

class ZendX_Wsdl_Api_Urrea_Pedidos {

    /**
     * 
     * Funcion que permite comprobar que exista el usuario y contraseña
     * 
     * @param type $idCliente
     * @param type $psw
     * @return type
     */
    public static function getPedidos($idCliente) {
        /* arreglo de retorno */
        if (null !== $idCliente || $idCliente !== 0) {
            $pedidosMapper = new Wsdl_Model_ModpedidosMapper();
            $pedidos = $pedidosMapper->getPedidos($idCliente);
            if (!empty($pedidos)) {
                $ptsMapper = new Wsdl_Model_ModpuntosMapper();
                $pts = $ptsMapper->getAcumulados($idCliente);
                $pedidos['disponibles'] = $pts - $pedidos['total'];
            }
            /* retornar valores del arreglo */
            return ZendX_Utilities_SecurityWSCheck::crypt(json_encode($pedidos));
        }
        throw new Exception('Usuario inexistente', '10', '');
    }

    /**
     * 
     * Funcion que permite comprobar que exista el usuario y contraseña
     * 
     * @param type $idCliente
     * @param type $psw
     * @return type
     */
    public static function setPedidos($params) {
        if (null !== $params && 0 !== $params) {
            $pedidos = self::_getArray($params);
            $pedidosMapper = new Wsdl_Model_ModpedidosMapper();
            $order = $pedidosMapper->geneateOrderNumber();
            $pts = new Wsdl_Model_ModpuntosMapper();
            $total = (int) $pedidos['total'];
            $idCliente = (int) $pedidos['idcliente'];
            $disp = $pts->getPuntosDisponibles($idCliente);
            if ($disp >= $total) {
                unset($pedidos['idcliente']);
                unset($pedidos['total']);
                $empresarial = $imax = array();
                foreach ($pedidos as $pedido) {
                    /* arreglo de retorno */
                    $pedidoObj = new Wsdl_Model_Modpedidos($pedido);
                    if ($disp >= $pedidoObj->getImporte()) {
                        $pedidoObj->setOrdernumber($order)
                                ->setIdcliente($idCliente);
                        $nextCodes = $pedidosMapper->write($pedidoObj);
                        if ($nextCodes !== null) {
                            foreach ($nextCodes as $nextCode) {
                                if ($nextCode['tipo'] === 1) {
                                    array_push($empresarial, array('codigo' => $nextCode['codigo']));
                                } else {
                                    array_push($imax, array('codigo' => $nextCode['codigo']));
                                }
                            }
                        }
                        $disp-=$pedidoObj->getImporte();
                    } else {
//                    $pedidoObj->setEstatus(-2);
                    }
                }
                $return = array('order' => $order);
                if (!empty($imax)) {
                    $return['codigos']['imax'] = $imax;
                }
                if (!empty($empresarial)) {
                    $return['codigos']['empresarial'] = $empresarial;
                }
                return ZendX_Utilities_SecurityWSCheck::crypt(json_encode($return));
            }
            throw new Exception('Puntos insuficientes', '10', NULL);
        }
        throw new Exception('Usuario inexistente', '10', '');
    }

    private static function _getArray($params) {
        $jsonParser = new ZendX_Action_Helper_Jsontoarray();
        $datos = ZendX_Utilities_SecurityWSCheck::decrypt($params);
        return $jsonParser->setJsontoarray($datos);
    }

}