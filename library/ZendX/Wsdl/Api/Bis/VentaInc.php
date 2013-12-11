<?php

class ZendX_Wsdl_Api_Bis_VentaInc {

    public static function getBiVtaInc() {
        /* arreglo de retorno */
        $return = array();
        $verify = new ZendX_Utilities_SecurityWSCheck();
//        if ($verify->isValid($data)) {
            $table = new Zend_Db_Table(array('db' => 'db1', 'name' => 'mod_metas'));
            $periodosMapper = new Ccm_Model_CatperiodosMapper();
            $periodos = $periodosMapper->getAll();
            foreach ($periodos as $periodo) {
                $idPeriodo = $periodo['id'];
                $metapv = $ventapv =  0;
                $select = $table->select()
                         ->setIntegrityCheck(false)
                        ->from(array('a' => 'mod_metas'), array('sum(a.metas) as total'))
                        ->join(array('b' => 'mod_clientes'), 'a.id_cliente = b.id', array())
                        ->where('a.id_periodo=?', $idPeriodo)
                        ->where('b.locked=?', 0);
                $result = $table->fetchRow($select);
                if (null !== $result) {
                    $metapv = (float) $result->total;
                }


                $select = $table->select()
                         ->setIntegrityCheck(false)
                        ->from(array('a' => 'mod_ventas'), array('sum(a.ventas) as total'))
                        ->join(array('b' => 'mod_clientes'), 'a.id_cliente = b.id', array())
                        ->where('a.id_periodo=?', $idPeriodo)
                        ->where('b.locked=?', 0);

                $result = $table->fetchRow($select);
                
                if (null !== $result) {
                    $ventapv = (float) $result->total;
                }
//
                $return[$periodo['nombre']] = array('totalventa' => $ventapv, 'totalmeta' => $metapv);
////            }
        }
        return json_encode($return);
    }

    public static function getBiVentaCero($data) {
        /* arreglo de retorno */
        $return = array();
        $verify = new ZendX_Utilities_SecurityWSCheck();
        if ($verify->isValid($data)) {
            $periodosMapper = new Ccm_Model_CatperiodosMapper();
            $periodos = $periodosMapper->getAll();
            $pv = $cc = 0;

            $table = new Zend_Db_Table(array('db' => 'db1', 'name' => 'mod_clientes'));
            $select = $table->select()
                    
                    ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                    /** comentado a peticion del lciente *
                      ->where('a.locked=?', 0)
                     */
                    ->where('a.id_canal IN(?)', array(1, 4));
            $result = $table->fetchAll($select)->toArray();
            if (!empty($result)) {
                $pv = (int) $result[0]['total'];
            }

            $select = $table->select()
                    ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                    /** comentado a peticion del lciente *
                      ->where('a.locked=?', 0)
                     */
                    ->where('a.id_canal IN(?)', array(2, 3));
            $result = $table->fetchAll($select)->toArray();
            if (!empty($result)) {
                $cc = (int) $result[0]['total'];
            }

            foreach ($periodos as $periodo) {
                $idPeriodo = $periodo['id'];
                $ventapv = $ventacc = 0;


                $table = new Zend_Db_Table(array('db' => 'db1', 'name' => 'mod_clientes_ventas'));
                $select = $table->select()
                        ->from(array('a' => 'mod_clientes_ventas'), array('COUNT(*) as total'))
                        ->join(array('b' => 'mod_clientes'), 'a.id_cliente = b.id', array())
                        ->where('a.id_periodo=?', $idPeriodo)
                        ->where('a.hectolitros=0')
                        /** comentado a peticion del lciente *
                          ->where('b.locked=?', 0)
                         */
                        ->where('b.id_canal IN(?)', array(1, 4));

                $result = $table->fetchAll($select)->toArray();
                if (!empty($result)) {
                    $ventapv = (int) $result[0]['total'];
                }
                $select = $table->select()
                        ->from(array('a' => 'mod_clientes_ventas'), array('COUNT(*) as total'))
                        ->join(array('b' => 'mod_clientes'), 'a.id_cliente = b.id', array())
                        ->where('a.id_periodo=?', $idPeriodo)
                        ->where('a.cajas_vendidas=0')
                        /** comentado a peticion del lciente *
                          ->where('b.locked=?', 0)
                         */
                        ->where('b.id_canal IN(?)', array(2, 3));
                $result = $table->fetchAll($select)->toArray();
                if (!empty($result)) {
                    $ventacc = (int) $result[0]['total'];
                }

                $return[$periodo['nombre']] =
                        array(
                            'pv' => array('totalclientes' => $pv, 'totalventa0' => $ventapv),
                            'cc' => array('totalclientes' => $cc, 'totalventa0' => $ventacc)
                );
            }
        }
        return json_encode($return);
    }

}