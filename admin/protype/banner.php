<?php

namespace SmartWeb\Models;

// $ds = DIRECTORY_SEPARATOR;
// $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
// require_once("{$base_dir}model{$ds}db.php");

class Banner extends Product
{
    private static Banner $banner;

    public static function getInstance()
    {
        if (empty($banner)) {
            self::$banner = new self(self::$db);
        }
        return self::$banner;
    }

    public function getBannerList()
    {
        $sql = "SELECT * FROM `banner`";
        $is_finished =  $this->db->select($sql);
        return $is_finished;
    }

    public function insert(array $param)
    {
        $sql = "INSERT INTO banner(BannerImage,BannerTitle,BannerSubTitle) 
        VALUES(:BannerImage, :BannerTitle, :BannerSubTitle)";

        $is_finished =  $this->db->notSelect($sql, $param);
        return $is_finished;
    }

    public function delete($params)
    {
        $sql = "DELETE FROM banner WHERE BannerId =:BannerId";
        $is_finished =  $this->db->notSelect($sql, $params);
        return $is_finished;
    }

    public function update($params)
    {
        $sql = "";
        if (empty($params['BannerImage'])) {
            $sql = "UPDATE banner
            SET BannerTitle=:BannerTitle, BannerSubTitle=:BannerSubTitle
            WHERE BannerId =:BannerId";
        } else {
            $sql = "UPDATE banner 
            SET BannerImage=:BannerImage, BannerTitle=:BannerTitle, BannerSubTitle=:BannerSubTitle
            WHERE BannerId =:BannerId";
        }

        $is_finished =  $this->db->notSelect($sql, $params);
        return $is_finished;
    }
    public function getBannerID($id)
    {
        $sql = "SELECT * FROM banner 
        WHERE banner.BannerId=:BannerId";

        $params['BannerId'] = $id;
        $result = $this->db->select($sql, $params);
        return $result;
    }
    public function sumb($a, $b){
        return $a + $b;
    }
    public function startTransaction()
    {
        self::$_connection->begin_transaction();
    }

    public function rollBack()
    {
        self::$_connection->rollback();
    }
}
