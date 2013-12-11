<?php

class ZendX_Wsdl_Api_Bis_Pde {

    public static function getBiPde($data) {
        /* arreglo de retorno */
        $return = array();
        $verify = new ZendX_Utilities_SecurityWSCheck();
        if ($verify->isValid($data)) {
            $periodosMapper = new Ccm_Model_CatperiodosMapper();
            $periodos = $periodosMapper->getAll();

            $table = new Zend_Db_Table(array('db' => 'db1', 'name' => 'mod_clientes'));
            $select = $table->select()
                    ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                    ->where('a.locked=?', 0)
                    ->where('a.id_canal IN(?)', array(1, 4));
            $result = $table->fetchAll($select)->toArray();
            if (!empty($result)) {
                $pv = (int) $result[0]['total'];
            }

            $select = $table->select()
                    ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                    ->where('a.locked=?', 0)
                    ->where('a.id_canal IN(?)', array(2, 3));
            $result = $table->fetchAll($select)->toArray();
            if (!empty($result)) {
                $cc = (int) $result[0]['total'];
            }

            foreach ($periodos as $periodo) {
                $epv = $ecc = 0;
                $idPeriodo = $periodo['id'];

                $select = $table->select()
                        ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                        ->join(array('b' => 'mod_evaluacion'), 'a.id = b.id_cliente', array())
                        ->where('b.id_periodo=?', $idPeriodo)
                        ->where('a.locked=?', 0)
                        ->where('a.id_canal IN(?)', array(1, 4));
                $result = $table->fetchAll($select)->toArray();
                if (!empty($result)) {
                    $epv = (int) $result[0]['total'];
                }
                $select = $table->select()
                        ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                        ->join(array('b' => 'mod_evaluacion'), 'a.id = b.id_cliente', array())
                        ->where('b.id_periodo=?', $idPeriodo)
                        ->where('a.locked=?', 0)
                        ->where('a.id_canal IN(?)', array(2, 3));
                $result = $table->fetchAll($select);
                
                if (!empty($result)) {
                    $ecc = (int) $result[0]['total'];
                }
                $return[$periodo['nombre']] =
                        array(
                            'pv' => array('totalclientes' => $pv, 'evaluados' => $epv),
                            'cc' => array('totalclientes' => $cc, 'evaluados' => $ecc)
                );
            }
        }
        return json_encode($return);
    }

}