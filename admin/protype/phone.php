<?php

namespace SmartWeb\Models;
use SmartWeb\Models\CSRFToken;
include "CSRFToken.php";
class Phone extends Product
{
    private static Phone $phone;

    public static function getInstance()
    {
        if (empty(static::$phone)) {
            static::$phone = new self(new DBPDO());
        }

        return static::$phone;
    }

    public function getMaxID()
    {
        $sql = "SELECT MAX(ProductID) ProductID FROM products";
        $id_current_product = $this->db->select($sql);
        $result = $id_current_product[0]['ProductID'];
        return $result;
    }

    public function getPhone()
    {
        $sql = "SELECT * 
        FROM products";

        $result = $this->db->select($sql);
        return $result;
    }

    public function getProductID($id)
    {
        $result = null;
        if(is_int($id))
        {
            $sql = "SELECT property.*, products.* 
            FROM products INNER JOIN property ON products.ProductID = property.ProductID 
            WHERE products.ProductID=:ProductID";
    
            $params['ProductID'] = $id;
            $result = $this->db->select($sql, $params);
            $_SESSION["Hash"]=$result[0]["Hash"]= CSRFToken::GenerateToken();
        }
        
        return $result;
    }

    public function getProduct()
    {
        $sql = "SELECT property.*, products.* FROM products INNER JOIN property ON products.ProductID = property.ProductID";
        $result = $this->db->select($sql);
        
        return $result;
    }

    public function insert($param)
    {
        $is_finished = false;
        if(is_array($param))
        {
            $sql = "INSERT INTO products(ProductName,CategoryID,ManufacturerID) 
            VALUES(:ProductName, :CategoryID, :ManufacturerID)";
    
            $is_finished =  $this->db->notSelect($sql, $param);
        }
        return $is_finished;
    }

    public function delete($id)
    {
        $is_finished = false;
        if(is_int($id))
        {
            $params["ProductID"] = $id;
            $sql = "DELETE FROM products WHERE ProductID = :ProductID";
            $is_finished =  $this->db->notSelect($sql, $params);
        }
        return $is_finished;
    }

    public function update($params)
    {
        $is_finished = false;
        if(is_array($params) && isset($_SESSION["Hash"]) && CSRFToken::CompareTokens($params["Hash"], $_SESSION["Hash"]))
        {
            $sql = "UPDATE products 
            SET ProductName=:ProductName, CategoryID=:CategoryID, ManufacturerID=:ManufacturerID
            WHERE ProductID=:ProductID";
            
            unset($params['Hash']);
            
            $is_finished =  $this->db->notSelect($sql, $params);
           
            if ($is_finished) {
                $id = $params['ProductID'];
                
                $is_finished =  $this->setVersion($id);
                
            }
        }
       
        return $is_finished;
    }

    public function getVersion($id)
    {
        if(is_int($id))
        {
            $sql = "SELECT products.Version  Version
            FROM products INNER JOIN property ON products.ProductID = property.ProductID
            WHERE products.ProductID =:ProductID";
            $params['ProductID'] = $id;
            $result = $this->db->select($sql, $params);
            return $result[0];
        }
        return null;
    }

    public function setVersion($param)
    {
        $is_finished = false;
        if(is_int($param))
        {
            $sql = "UPDATE products 
            SET Version = Version + 1
            WHERE ProductID =:ProductID";
            $params = ['ProductID' => $param];
            $is_finished =  $this->db->notSelect($sql, $params);
            return $is_finished;
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
