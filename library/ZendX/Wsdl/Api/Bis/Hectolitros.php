<?php

class ZendX_Wsdl_Api_Bis_Hectolitros {

    public static function getBiHectolitros($data) {
        /* arreglo de retorno */
        $return = array();
        $verify = new ZendX_Utilities_SecurityWSCheck();
        if ($verify->isValid($data)) {
            $periodosMapper = new Ccm_Model_CatperiodosMapper();
            $periodos = $periodosMapper->getAll();
            foreach ($periodos as $periodo) {
                $idPeriodo = $periodo['id'];
                $metapv = $ventapv = $metacc = $ventacc = 0;
                
                
                $table = new Zend_Db_Table(array('db' => 'db1', 'name' => 'mod_metas_cajas'));
                $select = $table->select()
                        ->from(array('a' => 'mod_metas_cajas'), array('sum(a.hectolitros) as total'))
                        ->join(array('b' => 'mod_clientes'), 'a.id_cliente = b.id', array())
                        ->where('a.id_periodo=?', $idPeriodo)
                        ->where('b.locked=?', 0)
                        ->where('b.id_canal IN(?)', array(1, 4));
                $result = $table->fetchAll($select)->toArray();
                if (!empty($result)) {
                    $metapv = (double) $result[0]['total'];
                }
                $select = $table->select()
                        ->from(array('a' => 'mod_metas_cajas'), array('sum(a.hectolitros) as total'))
                        ->join(array('b' => 'mod_clientes'), 'a.id_cliente = b.id', array())
                        ->where('a.id_periodo=?', $idPeriodo)
                        ->where('b.locked=?', 0)
                        ->where('b.id_canal IN(?)', array(2, 3));
                $result = $table->fetchAll($select)->toArray();
                if (!empty($result)) {
                    $metacc = (double) $result[0]['total'];
                }
                $table = new Zend_Db_Table(array('db' => 'db1', 'name' => 'mod_clientes_ventas'));
                $select = $table->select()
                        ->from(array('a' => 'mod_clientes_ventas'), array('sum(a.hectolitros) as total'))
                        ->join(array('b' => 'mod_clientes'), 'a.id_cliente = b.id', array())
                        ->where('a.id_periodo=?', $idPeriodo)
                        ->where('b.locked=?', 0)
                        ->where('b.id_canal IN(?)', array(1, 4));

                $result = $table->fetchAll($select)->toArray();
                if (!empty($result)) {
                    $ventapv = (double) $result[0]['total'];
                }
                $select = $table->select()
                        ->from(array('a' => 'mod_clientes_ventas'), array('sum(a.hectolitros) as total'))
                        ->join(array('b' => 'mod_clientes'), 'a.id_cliente = b.id', array())
                        ->where('a.id_periodo=?', $idPeriodo)
                        ->where('b.locked=?', 0)
                        ->where('b.id_canal IN(?)', array(2, 3));
                $result = $table->fetchAll($select)->toArray();
                if (!empty($result)) {
                    $ventacc = (double) $result[0]['total'];
                }
                $return[$periodo['nombre']] =
                        array(
                            'pv' => array('totalventahl' => $ventapv, 'totalmetahl' => $metapv),
                            'cc' => array('totalventahl' => $ventacc, 'totalmetahl' => $metacc)
                );
            }
        }    
        return $return;
    }

}