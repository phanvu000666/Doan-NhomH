<?php

namespace SmartWeb\Models;



class Banner
extends Product
{
    private static Banner $banner;

    public static function getInstance()
    {
        if (empty(static::$banner)) {
            static::$banner = new self(new DBPDO());
        }
        return static::$banner;
    }

    public function getBannerList()
    {
        $sql = "SELECT * FROM `banner`";
        $is_finished =  $this->db->select($sql);
        return $is_finished;
    }

    public function insert(array $param)
    {
        $is_finished = false;
        if (is_array($param) && count($param) == 3) {
            $sql = "INSERT INTO banner(BannerImage,BannerTitle,BannerSubTitle) 
            VALUES(:BannerImage, :BannerTitle, :BannerSubTitle)";
            $is_finished =  $this->db->notSelect($sql, $param);
        }
        return $is_finished;
    }

    public function delete($params)
    {
        $is_finished = !empty($params['BannerId']);
        $sql = "DELETE FROM banner WHERE BannerId =:BannerId";
        $is_finished =  $this->db->notSelect($sql, $params);
        return $is_finished;
    }

    public function update($params)
    {
        $sql = "";
        $is_finished = false;
        if (is_array($params) && count($params) >= 3) {
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
    }
    public function getVersion($id)
    {
        $sql = "SELECT banner.Version FROM banner 
        WHERE banner.BannerId=:BannerId";

        $params['BannerId'] = $id;
        $result = $this->db->select($sql, $params);
        return $result;
    }
    public function setVersion($id)
    {
        $is_finished = false;
        if(is_int($id)){

            $sql = "UPDATE banner SET Version = Version + 1 WHERE BannerId =:BannerId";
            
            $param = ["BannerId" => $id];
            $is_finished =  $this->db->notSelect($sql, $param);
        }
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
    public function startTransaction()
    {
        $this->db->getConnect()->beginTransaction();
    }

    public function rollBack()
    {
        $this->db->getConnect()->rollback();
    }
}
