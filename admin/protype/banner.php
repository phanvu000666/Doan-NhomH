<?php

namespace SmartWeb\Models;

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
            SET BannerImage=:BannerImage, BannerTitle=:BannerTitle, BannerSubTitle=:BannerSubTitle
            WHERE BannerId =:BannerId";
            //remove
            unset($params['BannerImage']);
        } else {
            $sql = "UPDATE banner 
            SET BannerImage=:BannerImage, BannerTitle=:BannerTitle, BannerSubTittle=:BannerSubTittle
            WHERE BannerId =:BannerId";
        }
        $is_finished =  $this->db->notSelect($sql, $params);
        return $is_finished;
    }
}
