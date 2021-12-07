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
        if (empty($phone)) {
            self::$phone = new self(self::$db);
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
        $sql = "SELECT * FROM $this->tbl_cate WHERE $this->CategoryID = $id";
        $is_finished =  $this->db->select($sql);
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
            return $is_finished;
        } else {
            return [
                'success' => false,
                'message' => "Parameters is not accord!"
            ];
            die();
        }
    }

    public function insertOne($input)
    {
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
            return $is_finished;
        } else {
            return [
                'success' => false,
                'message' => "Parameters is not accord!"
            ];
            die();
        }

       
    }
}
