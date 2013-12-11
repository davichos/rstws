<?php

class ZendX_Wsdl_Api_Bis_PdeDesglose {

    public static function getBiPdeDesglose() {
        $return = array();

        $table = new Zend_Db_Table(array('db' => 'db1', 'name' => 'mod_clientes'));
        $select = $table->select()
                ->setIntegrityCheck(false)
                ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                ->where('a.locked=?', 0);
        $result = $table->fetchRow($select);
        $totClientes = 0;
        if (null !== $result) {
            $totClientes = (int) $result->total;
        }

//        if ($verify->isValid($data)) {
        $pv1 = $pv2 = 0;
        $periodosMapper = new Ccm_Model_CatperiodosMapper();
        $periodos = $periodosMapper->getAll();

        foreach ($periodos as $periodo) {
            $idPeriodo = $periodo['id'];

            $select = $table->select()
                    ->setIntegrityCheck(false)
                    ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                    ->join(array('b' => 'mod_evaluacion'), 'a.id = b.id_cliente', array())
                    ->where('b.q=?', 1)
                    ->where('b.id_periodo=?', $idPeriodo)
                    ->where('a.locked=?', 0);
            $result = $table->fetchRow($select);
            if (null !== $result) {
                $pv1 = (int) $result->total;
            }
            $select = $table->select()
                    ->setIntegrityCheck(false)
                    ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                    ->join(array('b' => 'mod_evaluacion'), 'a.id = b.id_cliente', array())
                    ->where('b.q=?', 2)
                    ->where('b.id_periodo=?', $idPeriodo)
                    ->where('a.locked=?', 0);
            $result = $table->fetchRow($select);
            if (null !== $result) {
                $pv2 = (int) $result->total;
            }

            $return[$periodo['nombre']] = array(
                'totalclientes' => $totClientes,
                'q1' => array(
                    'evaluados' => $pv1,
                    'si' => array(
                        'planograma' => self::getResult('planograma', 1, $idPeriodo,1),
                        'colocacion' => self::getResult('colocacion', 1, $idPeriodo,1),
                        'exhibicion' => self::getResult('exhibicion', 1, $idPeriodo,1)),
                    'no' => array(
                        'planograma' => self::getResult('planograma', 0, $idPeriodo,1),
                        'colocacion' => self::getResult('colocacion', 0, $idPeriodo,1),
                        'exhibicion' => self::getResult('exhibicion', 0, $idPeriodo,1),
                    ),
                ),
                'q2' => array(
                    'evaluados' => $pv2,
                    'si' => array(
                        'planograma' => self::getResult('planograma', 1, $idPeriodo,2),
                        'colocacion' => self::getResult('colocacion', 1, $idPeriodo,2),
                        'exhibicion' => self::getResult('exhibicion', 1, $idPeriodo,2)),
                    'no' => array(
                        'planograma' => self::getResult('planograma', 0, $idPeriodo,2),
                        'colocacion' => self::getResult('colocacion', 0, $idPeriodo,2),
                        'exhibicion' => self::getResult('exhibicion', 0, $idPeriodo,2),
                    ),
                )
            );
        }
//        }
        return json_encode($return);
    }

    private static function getResult($key, $value, $idPeriodo, $q) {
        $table = new Zend_Db_Table(array('db' => 'db1', 'name' => 'mod_clientes'));
        $select = $table->select()
                ->setIntegrityCheck(false)
                ->from(array('a' => 'mod_clientes'), array('COUNT(*) as total'))
                ->join(array('b' => 'mod_evaluacion'), 'a.id = b.id_cliente', array())
                ->where('b.id_periodo=?', $idPeriodo)
                ->where('b.q=?', $q)
                ->where('b.' . $key . '=?', $value)
                ->where('a.locked=?', 0);
        $result = $table->fetchRow($select);
        if (null !== $result) {
            return (int) $result->total;
        }
        return 0;
    }

}