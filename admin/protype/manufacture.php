<?php

namespace SmartWeb\Models;
use SmartWeb\Models\DBPDO;
use SmartWeb\Models\CSRFToken;
class Manufacture extends Product
{
    private static Manufacture $manu;

    public static function getInstance()
    {
        if (empty(static::$manu)) {
            static::$manu = new self(new DBPDO());
        }
        return static::$manu;
    }

    public function getManu()
    {
        $sql = "SELECT * FROM manufacturers";
        $is_finished =  $this->db->select($sql);
        return $is_finished;
    }
    public function getManuID($id)
    {
        $sql = "SELECT * FROM manufacturers WHERE ManufacturerID =:ManufacturerID";
        $params['ManufacturerID'] = $id;
        $result = $this->db->select($sql, $params);
        return $result;
    }

    public function insert(array $param)
    {   
        if (is_array($param) && count($param) == 1) {
            $sql = "INSERT INTO manufacturers(ManufacturerName) 
            VALUES(:ManufacturerName)";
            $is_finished =  $this->db->notSelect($sql, $param);
        }
        return $is_finished;
    }

    public function delete($params)
    {
        $is_finished = !empty($params['ManufacturerID']);
        $sql = "DELETE FROM manufacturers WHERE ManufacturerID = :ManufacturerID";
        $is_finished =  $this->db->notSelect($sql, $params);
        return $is_finished;
    }

    public function update($params)
    {
        // var_dump($params);die();
        // array(3) { ["ManufacturerID"]=> string(2) "13" ["ManufacturerName"]=> string(4) "Dell" ["Version"]=> string(1) "0" }
                // tang version neu so sanh thanh cong.
        $params['Version'] = $params['Version'] + 1;
        $sql = "UPDATE manufacturers 
        SET ManufacturerName= :ManufacturerName, `Version`=:Version WHERE ManufacturerID = :ManufacturerID";
        $is_finished =  $this->db->notSelect($sql, $params);
        // if ($is_finished) {
        //     $id = $params['ManufacturerID'];
        //     $is_finished =  $this->setVersion($id);
        // }
        return $is_finished;
    }

    public function getVersion($param)
    {
        $sql = "SELECT Version FROM manufacturers WHERE ManufacturerID =:ManufacturerID";
        $params = ['ManufacturerID' => $param];
        $result = $this->db->select($sql, $params);
        return $result[0];
        
    }

    private function setVersion($param)
    {
        $sql = "UPDATE manufacturers 
        SET Version = Version + 1
        WHERE ManufacturerID =:ManufacturerID";
        $params = ['ManufacturerID' => $param];
        $is_finished =  $this->db->notSelect($sql, $params);
        return $is_finished;
    }
    public function startTransaction()
    {
        $this->db->getConnect()->beginTransaction();
    }

    public function rollBack()
    {
        $this->db->getConnect()->rollback();
    }
}
