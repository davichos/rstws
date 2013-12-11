<?php
class ZendX_Action_Helper_Addusers extends Zend_Controller_Action_Helper_Abstract {
    public function getConcentrado($estado=1) {
        $concentrado = new ZendX_Utilities_Addusers();
        $esquemas = new Cnv_Model_EstadotemplateMapper();		
        $entries = $esquemas->readnewtempla();
		
        $allConc = $conce = array();
        foreach ($entries as $entri) {
		
            $concentrado->asignModel($entri->getId());
            $conce[] = $concentrado->consulta(1, $entri->getId());			
        }
        $conceArr = $this->getArray($conce);
        $conceFinal = $this->agrupaElementos($conceArr, 'nomina', 'idcatalogo');
        return $this->asingaIds($conceFinal);
    }

    public function agrupaElementos($array, $busqueda, $valorAgrupar) {
        $arrayAgrupado = $array;
        foreach ($array as $key => $value) {
            $t = $value;
            $c = '';
            foreach ($array as $k => $v) {
                if ($t[$busqueda] === $v[$busqueda] && $t['esquema'] === $v['esquema']) {
                    $c = $c . $v[$valorAgrupar] . ',';
                    unset($array[$k]);
                }
            }
            if ($c != '') {
                $arrayAgrupado[$key][$valorAgrupar] = substr($c, 0, (strlen($c) - 1));
            }else
                unset($arrayAgrupado[$key]);
        }
        //var_dump($arrayAgrupado);
        return $arrayAgrupado;
    }

    private function getArray($concentrado) {
        $allConc = array();
        foreach ($concentrado as $value) {
            if (!empty($value)) {
                foreach ($value as $key => $val) {
                    $allConc[] = $val;
                }
            }
        }
        return $allConc;
    }

    private function asingaIds($array) {
        $arr = array();
        $i = 1;
        foreach ($array as $value) {
            if (!empty($value)) {
                $arr[] = array_merge(array('id' => $i), $value);
                $i++;
            }
        }
//        var_dump($arr);
        return $arr;
    }

    public function actualizaElemento($elemento, array $arreglo, $valor=2) {
        if (!empty($arreglo)) {
            $id = (int) $arreglo['esquema'];
            unset($arreglo['esquema']);
            $concentrado = new ZendX_Utilities_ConcentradoGanadores();
            $concentrado->asignModel($id);
            foreach ($arreglo as $key => $item) {
                if ($item === '') {
                    unset($arreglo[$key]);
                }
            }
            $concentrado->cambiaElemento($elemento, $arreglo, $valor);
        }
    }	
}