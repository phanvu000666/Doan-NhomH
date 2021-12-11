<?php

namespace SmartWeb\Models;

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
        $is_finished = false;
        if (is_int($id)) {
            $sql = "SELECT * FROM $this->tbl_cate WHERE $this->CategoryID = $id";
            $is_finished =  $this->db->select($sql);
        }
        return $is_finished;
    }

    public function deleteOne($id)
    {
        $sql = "DELETE FROM `$this->tbl_cate` WHERE `$this->CategoryID` = :$this->CategoryID";
        $is_finished =  $this->db->notSelect($sql, [$this->CategoryID => $id]);
        return $is_finished;
    }

    public function updateOne($input)
    {
        $is_finished = false;
        if (is_array($input) && isset($_SESSION["Hash"]) && CSRFToken::CompareTokens($input["Hash"], $_SESSION["Hash"])) {
            if (
                isset($input[$this->CategoryID]) &&
                isset($input[$this->CategoryName]) &&
                isset($input[$this->Position]) &&
                isset($input[$this->Version])
            ) {
                $data = [
                    $this->CategoryID => $input[$this->CategoryID],
                    $this->CategoryName => $input[$this->CategoryName],
                    $this->Position => $input[$this->Position],
                    $this->Version => $input[$this->Version]
                ];

                $sql = "UPDATE $this->tbl_cate SET
                $this->CategoryName = :$this->CategoryName,
                $this->Position = :$this->Position,
                $this->Version = :$this->Version
                WHERE $this->CategoryID = :$this->CategoryID";

                $is_finished =  $this->db->notSelect($sql, $data);
            } else {
                return [
                    'success' => false,
                    'message' => "Parameters is not accord!"
                ];
                die();
            }
        }
        return $is_finished;
    }

    public function insertOne($input)
    {
        $is_finished = false;
        if (is_array($input) && count($input) === 2) {

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
            } else {
                return [
                    'success' => false,
                    'message' => "Parameters is not accord!"
                ];
                die();
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
