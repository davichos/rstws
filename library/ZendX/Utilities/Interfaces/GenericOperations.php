<?php

/**
 * Description of AsignaBd
 *
 * @author DGomez
 */
interface ZendX_Utilities_Interfaces_GenericOperations {

    public function findOne($id);

    public function insert($data);

    public function update($data, $idValue);

    public function findid($id, $keysubform);

    public function changeEstatus($array);

    public function getTimestamp($date = null);

    public function getDate($time = null);

    public function getEstatus($estatusId);

    public function getLastInsertId();

    public function setLastInsertId($lastInsertId);
}
