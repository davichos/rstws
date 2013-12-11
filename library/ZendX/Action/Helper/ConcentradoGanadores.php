<?php

/**
 * Description of ConcentradoGanadores
 *
 * @author DGomez
 */
class ZendX_Action_Helper_ConcentradoGanadores extends Zend_Controller_Action_Helper_Abstract {

    public function getConcentrado($estado, $page) {
        $concentrado = new ZendX_Utilities_ConcentradoGanadores();
        $entries = $this->getEntries();
        $allConc = $conce = array();
        foreach ($entries as $entri) {
            if ($entri->getId() != 4 && $entri->getId() != 5 && $entri->getId() != 7) {
                $concentrado->asignModel($entri->getId());
                $conce[] = $concentrado->consulta($estado, $entri->getConcepto(), $page);
            }
        }
        $conceArr = $this->getArray($conce);
        $conceFinal = $this->agrupaElementos($conceArr, 'nomina', 'idcatalogo');
        return $this->asingaIds($conceFinal, $page, 500);
    }

    public function filtroAvanzadoConcentrado($array) {
        if ($array['esquema'] === '')
            $entries = $this->getEntries();
        else
            $entries = $this->findEsquemaById($array['esquema']);
        unset($array['esquema']);
        $conce = array();
        foreach ($entries as $entri) {
            if ($entri->getId() === 6 || $entri->getId() === 3) {
                $concentrado = new ZendX_Utilities_ConcentradoGanadores();
                $concentrado->asignModel($entri->getId());
                $conce[] = $concentrado->getBd()->filtroAvanzadoConcgan($array, $entri->getConcepto());
            }
        }
        $conceArr = $this->getArray($conce);
        $conceFinal = $this->agrupaElementos($conceArr, 'nomina', 'idcatalogo');
        return $this->asingaIds($conceFinal,1,500);
    }

    private function getEntries() {
        $esquemas = new Cnv_Model_EstadotemplateMapper();
        return $esquemas->readnewtempla();
    }

    private function findEsquemaById($id) {
        $esquemas = new Cnv_Model_EstadotemplateMapper();
        return $esquemas->findEsquemaById($id);
    }

    public function agrupaElementos($array, $busqueda, $valorAgrupar) {
        $arrayAgrupado = $array;
        foreach ($array as $key => $value) {
            $t = $value;
            $c = '';
            foreach ($array as $k => $v) {
                if ($t[$busqueda] === $v[$busqueda] && $t['esquema'] === $v['esquema'] && $t['idq'] === $v['idq']) {
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
//                    $allConc[] =  array_merge(array('zxczxc' => 'true'),$val);
                    $allConc[] = $val;
                }
            }
        }
        return $allConc;
    }

    private function asingaIds($array, $page, $limit) {
        $arr = array();
        $i = (($page - 1) * $limit) + 1;
        foreach ($array as $value) {
            if (!empty($value)) {
                $arr[] = array_merge(array('id' => $i), $value);
                $i++;
            }
        }
//        var_dump($arr);
        return $arr;
    }

    public function actualizaElemento($elemento, array $arreglo, $estado, $valor = 3) {
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
            $concentrado->cambiaElemento($elemento, $arreglo, $estado, $valor);
        }
    }

    public function getPaginas() {
        $concentrado = new ZendX_Utilities_ConcentradoGanadores();
        $entries = $this->getEntries();
        $paginas = 0;
        foreach ($entries as $entri) {
            if ($entri->getId() != 4 && $entri->getId() != 5 && $entri->getId() != 7) {
                $concentrado->asignModel($entri->getId());
                $paginas+= $concentrado->getPaginas(3, 500);
            }
        }
        return $paginas;
    }

}

