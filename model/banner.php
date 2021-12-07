<?php

namespace SmartWeb;

class Banner extends Model
{
    private static Banner $_instance;

    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self(new DBMYSQL);
        }

        return self::$_instance;
    }
    function getDataDuaVaoID($id)
    {
        return $this->db->select("SELECT * FROM banner WHERE BannerId = $id");
    }
    
    public function getBanner()
    {
        $result = $this->db->select("SELECT * FROM banner LIMIT 4");
        return $result; //return an array

    }

    public function getCon()
    {
        return $this->con;
    }
}
