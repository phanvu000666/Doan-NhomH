<?php

namespace SmartWeb\Models;

class Property  extends Product
{
    private static Property $property;
    public static function getInstance(DB $db)
    {
        if (empty(static::$property)) {
            self::$property = new self(new DBPDO);
        }
        return self::$property;
    }
    
    public function getPropertyList()
    {
        $sql = "SELECT * FROM property";
        $result = $this->db->select($sql);
        return $result;
    }
    public function insert($param)
    {
        $is_finished = false;
        if(is_array($param))
        {
            $sql = "INSERT INTO property(ProductID,ImageUrl,Price,Quantity,Description) 
            VALUES(:ProductID, :ImageUrl, :Price, :Quantity, :Description)";
    
            $is_finished =  $this->db->notSelect($sql, $param);
        }
        
        return $is_finished;
    }

    public function delete($id)
    {
        $is_finished = false;
        if(is_int($id))
        {
            $sql = "DELETE FROM property WHERE ProductID = :ProductID";
            $params["ProductID"] = $id;
            $is_finished =  $this->db->notSelect($sql, $params);
        }
        return $is_finished;
    }

    public function update($params)
    {
        $is_finished = false;
        if(is_array($params) )
        {
            $sql = "";
            if (empty($params['ImageUrl'])) {
                $sql = "UPDATE property
                SET Price=:Price, Quantity=:Quantity, Description=:Description
                WHERE ProductID =:ProductID";
                //remove
                unset($params['ImageUrl']);
            } else {
                $sql = "UPDATE property 
                SET ImageUrl=:ImageUrl, Price=:Price, Quantity=:Quantity, Description=:Description
                WHERE ProductID =:ProductID";
            }
            $is_finished =  $this->db->notSelect($sql, $params);
        }
      
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
