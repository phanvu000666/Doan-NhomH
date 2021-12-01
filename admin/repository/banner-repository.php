<?php

namespace SmartWeb\Repository;

// use SmartWeb\DataBase\Product\Property;
use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Models\Product;
use SmartWeb\Models\Banner;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

class BannerRepository
{
    private static Banner $banner;

    public static function insert(array $params)
    {
        //initialize product and property.
        if (empty($banner)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$banner = $assembler->getComponent(Banner::class);
        }
        $is_finished = false;
        if (is_array($params)) {

            //add banner.
            $paramsbanner['BannerImage'] = htmlentities($params['BannerImage']);
            $paramsbanner['BannerTitle'] = htmlentities($params['BannerTitle']);
            $paramsbanner['BannerSubTitle']  = htmlentities($params['BannerSubTitle']);
            $is_finished =  static::$banner->insert($paramsbanner);
        }
        return $is_finished;
    }

    public static function delete($BannerId)
    {
        //initialize banner and property.
        if (empty($banner)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$banner = $assembler->getComponent(Banner::class);
        }

        //delete banner.
        $params['BannerId'] = $BannerId;
        self::$banner->delete($params);
    }

    public static function update($params)
    {
        //initialize banner.
        if (empty($banner)) {
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            $conf = "{$base_dir}dj{$ds}object.xml";
            $assembler = new ObjectAssembler($conf);

            static::$banner = $assembler->getComponent(Banner::class);
        }
        $is_finished = false;
        if (is_array($params)) {


            //add banner.
            $paramsbanner['BannerImage'] = htmlentities($params['BannerImage']);
            $paramsbanner['BannerTitle']  = htmlentities($params['BannerTitle']);
            $paramsbanner['BannerSubTitle'] = htmlentities($params['BannerSubTitle']);
            $paramsbanner['BannerId'] = (int)htmlentities($params['BannerId']);

            $is_finished =  static::$banner->update($paramsbanner);
        }

        return $is_finished;
    }
}
