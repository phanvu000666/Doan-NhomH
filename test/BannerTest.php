<?php


// use SmartWeb\DataBase\Product\Model;
// use SmartWeb\Models\Product;
use SmartWeb\Models\Banner;
// use SmartWeb\Models\
use SmartWeb\Models\DBPDO;
use SmartWeb\Controller\BannerController;

use PHPUnit\Framework\TestCase;


class BannerTest extends TestCase
{
   
    public function testSumbOK()
    {
        // var_dump($this);
        // $phone = new Phone();
        $banner = new Banner(new DBPDO());
        $exc=3;
        $act=$banner->sumb(1, 2);
        $this->assertEquals($exc, $act);
    }
    public function testGetBannerListOK()
    {
        // var_dump($this);
        // $phone = new Phone();
        $banner = new Banner(new DBPDO());
        $exc=14;
        $act=$banner->getBannerList();
        $this->assertEquals($exc, count($act));
    }

    public function testInsertOK()
    {
        $banner = new Banner(new DBPDO());
        $image = "âfasd";
        $title= "ádasda";
        $subTitle= "ádad";
        $params= ["BannerImage" => $image,"BannerTitle" => $title, "BannerSubTitle" =>$subTitle];
        $banner->startTransaction();
        $banner->insert($params);
        $this->assertEquals(15, count($banner->getBannerList()));
        $banner->rollback();
    }
    public function testInsertIsString()
    {
        $banner = new Banner(new DBPDO());
        $params= "fasd";
        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if(!$actual)
        {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertIsInt()
    {
        $banner = new Banner(new DBPDO());
        $params= 123;
        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if(!$actual)
        {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertIsObject()
    {
        $banner = new Banner(new DBPDO());
        $params = $banner;
        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if(!$actual)
        {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertIsNull()
    {
        $banner = new Banner(new DBPDO());
        $params = null;
        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if(!$actual)
        {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertIsEmpty()
    {
        $banner = new Banner(new DBPDO());
        $params = "";
        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if(!$actual)
        {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertImageIsInt()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = 123;
        $title= "ádasda";
        $subTitle= "ádad";
        //array.
        $params= ["BannerImage" => $image,"BannerTitle" => $title, "BannerSubTitle" =>$subTitle];
        //permitted
         $permitted = [
            'image/gif',
            'image/jpeg',
            'image/pjeg',
            'image/png',
            'image/webp'
        ];
        $getImage= getImageSize($image);
        if (!in_array($getImage["mime"], $permitted)) {
            $this->assertTrue(true);
        }
    }
    public function testInsertImageOK()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title= "ádasda";
        $subTitle= "ádad";
        //array.
        
        $params= ["BannerImage" => $image,"BannerTitle" => $title, "BannerSubTitle" =>$subTitle];
        //permitted
        $permitted = [
            'image/gif',
            'image/jpeg',
            'image/pjeg',
            'image/png',
            'image/webp'
        ];
        $getImage= getImageSize($image);
        if (in_array($getImage["mime"], $permitted)) {
            $this->assertTrue(true);
        }
    }
    public function testInsertImageNGDifType()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "hinh1.txt";
        $title= "ádasda";
        $subTitle= "ádad";
        //array.
        $params= ["BannerImage" => $image,"BannerTitle" => $title, "BannerSubTitle" =>$subTitle];
        $permitted = [
            'image/gif',
            'image/jpeg',
            'image/pjeg',
            'image/png',
            'image/webp'
        ];
        $getImage= getImageSize($image);
        if (!in_array($getImage["mime"], $permitted)) {
            $this->assertTrue(true);
        }
    }

}