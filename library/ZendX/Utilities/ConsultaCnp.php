<?php

class ZendX_Utilities_ConsultaCnp extends ZendX_Utilities_Bd {

    public function getConsultaFiltros($arreglo, $limit = 1000,$estado=3) {
        $select = null;
        if (!empty($arreglo) && $this->getBd() !== null) {
            $select = $this->getBd()->getDbTable()->select();
            foreach ($arreglo as $key => $item) {
                if ($item !== '')
                    $select->orwhere($key . '=?', $item);
            }
        }
        if (null !== $select) {
            $select->where('estado IN(?)', array(2, $estado))
                    ->limit($limit, 0);
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

}
