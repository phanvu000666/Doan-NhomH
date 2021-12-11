<?php

namespace SmartWeb\Models;
use SmartWeb\Models\CSRFToken;
include "CSRFToken.php";
class Category extends Product
{
    private static Category $phone;

    private $tbl_cate = "categories";
    private $CategoryID = "CategoryID";
    private $CategoryName = "CategoryName";
    private $Position = "Position";
    private $Version = "Version";

    public static function getInstance()
    {
        if (empty(static::$phone)) {
            self::$phone = new self(new DBPDO());
        }
        return self::$phone;
    }

    public function getCategory()
    {
        $sql = "SELECT * FROM $this->tbl_cate";
        $is_finished =  $this->db->select($sql);
        return $is_finished;
    }

    public function getOne($id)
    {
       
        if (is_int($id)) {
            $sql = "SELECT * FROM $this->tbl_cate WHERE $this->CategoryID = $id";
            $is_finished =  $this->db->select($sql);
            $is_finished[0]["Hash"] = $_SESSION["Hash"] = CSRFToken::GenerateToken(); 
        }
        return $is_finished ?? null;
    }

    public function deleteOne($id)
    {
        $sql = "DELETE FROM `$this->tbl_cate` WHERE `$this->CategoryID` = :$this->CategoryID";
        $is_finished =  $this->db->notSelect($sql, [$this->CategoryID => $id]);
        return $is_finished;
    }

    public function updateOne($input)
    {
        // var_dump($_POST);
        $is_finished = false;
        if (is_array($input) && isset($_SESSION["Hash"]) && CSRFToken::CompareTokens($input["Hash"], $_SESSION["Hash"])) {
            
                $data = [
                    $this->CategoryID => $input[$this->CategoryID],
                    $this->CategoryName => $input[$this->CategoryName],
                    $this->Position => $input[$this->Position],
                    
                ];

                $sql = "UPDATE $this->tbl_cate SET
                $this->CategoryName = :$this->CategoryName,
                $this->Position = :$this->Position
                
                WHERE $this->CategoryID = :$this->CategoryID";

                $is_finished =  $this->db->notSelect($sql, $data);
            
        }
        return $is_finished;
    }

    public function insertOne($input)
    {
        $is_finished = false;
        
        if (is_array($input) && count($input) >= 2) {

            if (
                isset($input[$this->CategoryName]) &&
                isset($input[$this->Position])
            ) {
                $data = [
                    $this->CategoryName => $input[$this->CategoryName],
                    $this->Position => $input[$this->Position],
                    $this->Version => 0
                ];
                $sql = "INSERT $this->tbl_cate 
            (
            $this->CategoryName,
            $this->Position,
            $this->Version
            )
            VALUES 
            (
            :CategoryName,
            :Position,
            :Version
            )";
                $is_finished =  $this->db->notSelect($sql, $data);
            }
        }
        return $is_finished;
    }
    public function getVersion($id)
    {
        $sql = "SELECT categories.Version FROM categories 
        WHERE categories.CategoryID=:CategoryID";

        $params['CategoryID'] = $id;
        $result = $this->db->select($sql, $params);
        return $result;
    }
    public function setVersion($id)
    {
        $is_finished = false;
        if (is_int($id)) {

            $sql = "UPDATE categories SET Version = Version + 1 WHERE CategoryID =:CategoryID";

            $param = ["CategoryID" => $id];
            $is_finished =  $this->db->notSelect($sql, $param);
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
