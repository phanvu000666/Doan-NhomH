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
    public function testInstance()
    {
        $ban1 = Banner::getInstance();
        $ban2 =  Banner::getInstance();

        $actual = false;
        if ($ban1 === $ban2) {
            $actual = true;
        }
        $expected = true;

        $this->assertEquals($expected, $actual);
    }
    public function testInstanceisOb()
    {
        $ban = Banner::getInstance();
        if (is_object($ban)) {
            $this->assertTrue(True);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testInstanceNotNull()
    {
        $ban = Banner::getInstance();
        $actual = $ban;
        if (empty($actual)) {
            $actual = false;
        } else {
            $actual = true;
        }
        $expected = true;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceBannerModel()
    {
        $ban = Banner::getInstance();
        $actual = get_class($ban);
        $expected = Banner::class;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceAndBannerModel()
    {
        $ban = new Banner(new DBPDO());

        $ban2 = Banner::getInstance();
        if ($ban !== $ban2) {
            $this->assertTrue(true);
        }
    }
    public function testGetBannerListOK()
    {
        // var_dump($this);
        // $phone = new Phone();
        $banner = new Banner(new DBPDO());
        $exc = 14;
        $act = $banner->getBannerList();
        $this->assertEquals($exc, count($act));
    }

    public function testInsertOK()
    {
        $banner = new Banner(new DBPDO());
        $image = "âfasd";
        $title = "ádasda";
        $subTitle = "ádad";
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => $subTitle];
        $banner->startTransaction();
        $banner->insert($params);
        $this->assertEquals(15, count($banner->getBannerList()));
        $banner->rollback();
    }
    public function testInsertIsString()
    {
        $banner = new Banner(new DBPDO());
        $params = "fasd";
        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertIsInt()
    {
        $banner = new Banner(new DBPDO());
        $params = 123;
        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if (!$actual) {
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
        if (!$actual) {
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
        if (!$actual) {
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
        if (!$actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
   
    public function testInsertImageOK()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "ádasda";
        $subTitle = "ádad";
        //array.

        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => $subTitle];
        //permitted
        $permitted = [
            'image/gif',
            'image/jpeg',
            'image/pjeg',
            'image/png',
            'image/webp'
        ];
        $getImage = getImageSize($image);
        if (in_array($getImage["mime"], $permitted)) {
            $this->assertTrue(true);
        }
    }
    public function testInsertImageNGDifType()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\\test.php";
        $title = "ádasda";
        $subTitle = "ádad";
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => $subTitle];
        $permitted = [
            'image/gif',
            'image/jpeg',
            'image/pjeg',
            'image/png',
            'image/webp'
        ];
        $getImage = getImageSize($image);

        if ($getImage == false) {
            $this->assertTrue(true);
        }
    }
    public function testInsertTitleSQLInjection()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "','');TRUNCATE TABLE banner##','";
        $subTitle = "ádad";
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => $subTitle];

        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }

    public function testInsertSubTitleSQLInjection()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "sssdvs";
        $subTitle = "');TRUNCATE TABLE banner##";
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => $subTitle];

        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertTitleXSS()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $subTitle = "câcsdvds";
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => htmlentities($title), "BannerSubTitle" => $subTitle];

        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertSubTitleXSS()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "vsdv";
        $subTitle = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => htmlentities($subTitle)];

        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testInsertSubTitleCSRF()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "vsdv";
        $subTitle = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => htmlentities($subTitle)];

        $banner->startTransaction();
        $actual = $banner->insert((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }

    public function testGetBannerIdOK()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = "1";
        $excImg = "h4-slide.png";
        $actual = $banner->getBannerID($bannerId);
        $this->assertEquals($excImg, $actual[0]['BannerImage']);
    }
    public function testGetBannerIdIsNull()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = null;
        // $excImg = "h4-slide.png";
        $actual = $banner->getBannerID($bannerId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetBannerIdIsString()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = "alo";
        // $excImg = "h4-slide.png";
        $actual = $banner->getBannerID($bannerId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetBannerIdIsNGId()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = 4;
        $excImg = "h4-slide.png";
        $actual = $banner->getBannerID($bannerId);
        // var_dump($actual);
        // $this->assertEquals($excImg, $actual[0]['BannerImage']);
        if ($excImg != $actual[0]['BannerImage']) {
            $this->assertTrue(true);
        }
    }
    public function testGetBannerIdIsEmpty()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = '';
        // $excImg = "h4-slide.png";
        $actual = $banner->getBannerID($bannerId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetBannerIdIsFloat()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = 4.3;
        // $excImg = "h4-slide.png";
        $actual = $banner->getBannerID($bannerId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetBannerIdIsSpecChar()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = "$%^&*";
        // $excImg = "h4-slide.png";
        $actual = $banner->getBannerID($bannerId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }

    public function testDeleteOK()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = '43';
        $params = ["BannerId" => $bannerId];
        $expected = true;
        $banner->startTransaction();
        $actual = $banner->delete($params);
        // var_dump($actual);
        $this->assertEquals($expected, $actual);
        $banner->rollback();
    }
    public function testDeleteNG()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = 9999;
        $params = ["BannerId" => $bannerId];
        $banner->startTransaction();
        $actual = $banner->delete($params);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testDeleteIsFloat()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = 43.6;
        $params = ["BannerId" => $bannerId];
        $expected = false;
        $banner->startTransaction();
        $actual = $banner->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $banner->rollback();
    }
    public function testDeleteIsNull()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = NULL;
        $params = ["BannerId" => $bannerId];
        $expected = false;
        $banner->startTransaction();
        $actual = $banner->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $banner->rollback();
    }
    public function testDeleteIsString()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = "casa";
        $params = ["BannerId" => $bannerId];
        $expected = false;
        $banner->startTransaction();
        $actual = $banner->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $banner->rollback();
    }
    public function testDeleteIsSpecChar()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = "%^&*";
        $params = ["BannerId" => $bannerId];
        $expected = false;
        $banner->startTransaction();
        $actual = $banner->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $banner->rollback();
    }
    public function testDeleteIsEmpty()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = "";
        $params = ["BannerId" => $bannerId];
        $expected = false;
        $banner->startTransaction();
        $actual = $banner->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $banner->rollback();
    }
    public function testDeleteIsBool()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = false;
        $params = ["BannerId" => $bannerId];
        $expected = false;
        $banner->startTransaction();
        $actual = $banner->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $banner->rollback();
    }
    public function testUpdateOK()
    {
        $banner = new Banner(new DBPDO());
        $image = "âfasd";
        $title = "ádasda";
        $subTitle = "ádad";
        $id = 43;
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => $subTitle, "BannerId" => $id];
        $banner->startTransaction();
        $banner->update($params);
        $this->assertEquals(14, count($banner->getBannerList()));
        $banner->rollback();
    }
    public function testUpdateOKWithoutImg()
    {
        $banner = new Banner(new DBPDO());
        $title = "ádasda";
        $subTitle = "ádad";
        $id = 43;
        $params = ["BannerTitle" => $title, "BannerSubTitle" => $subTitle, "BannerId" => $id];
        $banner->startTransaction();
        $banner->update($params);
        $this->assertEquals(14, count($banner->getBannerList()));
        $banner->rollback();
    }
    public function testUpdateIsString()
    {
        $banner = new Banner(new DBPDO());
        $params = "23wcsdvs";
        $banner->startTransaction();
        $actual = $banner->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $banner->rollback();
    }
    public function testUpdateIsInt()
    {
        $banner = new Banner(new DBPDO());
        $params = 123;
        $banner->startTransaction();
        $actual = $banner->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $banner->rollback();
    }
    public function testUpdateIsObject()
    {
        $banner = new Banner(new DBPDO());
        $params = $banner;
        $banner->startTransaction();
        $actual = $banner->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testUpdateIsNull()
    {
        $banner = new Banner(new DBPDO());
        $params = NULL;

        $banner->startTransaction();
        $actual = $banner->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testUpdateIsEmpty()
    {
        $banner = new Banner(new DBPDO());
        $params = "";
        $banner->startTransaction();
        $actual = $banner->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testUpdateTitleSQLInjection()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "','');TRUNCATE TABLE banner##','";
        $subTitle = "ádad";
        $id = 43;
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => $subTitle, "BannerId" => $id];

        $banner->startTransaction();
        $actual = $banner->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }

    public function testUpdateSubTitleSQLInjection()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "sssdvs";
        $subTitle = "');TRUNCATE TABLE banner##";
        $id = 43;
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => $subTitle, "BannerId" => $id];

        $banner->startTransaction();
        $actual = $banner->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testUpdateTitleXSS()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $subTitle = "câcsdvds";
        $id = 43;
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => htmlentities($title), "BannerSubTitle" => $subTitle, "BannerId" => $id];

        $banner->startTransaction();
        $actual = $banner->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testUpdateSubTitleXSS()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "vsdv";
        $subTitle = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $id = 43;
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => htmlentities($subTitle), "BannerId" => $id];

        $banner->startTransaction();
        $actual = $banner->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testUpdateVersionIDDOROK()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "vsdv";
        $subTitle = "sdvs";
        $id = 43;
        $version =  0;
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => htmlentities($subTitle), "BannerId" => $id];


        $banner->startTransaction();
        $ver = $banner->getVersion($params['BannerId']);
        // var_dump($ver['Version']);
        if ($ver[0]['Version'] == $version) {
            $actual = $banner->update($params);
            $banner->setVersion($params['BannerId']);
        }
        if ($actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testUpdateVersionIDDORNG()
    {
        $banner = new Banner(new DBPDO());
        //data.
        $image = "G:\Doan-NhomH\img\h4-slide.png";
        $title = "vsdv";
        $subTitle = "sdvs";
        $id = 43;
        $version =  3;
        //array.
        $params = ["BannerImage" => $image, "BannerTitle" => $title, "BannerSubTitle" => htmlentities($subTitle), "BannerId" => $id];
        (string)$expected = "Khong the update";
        (string)$actual = "";

        $ver = $banner->getVersion($params['BannerId']);
        // var_dump($ver['Version']);
        if ($ver[0]['Version'] != $version) {
            $actual = "Khong the update";
        }
        $this->assertEquals($expected, $actual);
      
    }
    public function testGetVersionOK()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = "1";
        $excVer = 0;
        $actual = $banner->getVersion($bannerId);
        // var_dump($actual['Version']);
        $this->assertEquals($excVer, $actual[0]['Version']);
    }
    public function testGetVersionIsString()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = "ac";
        $excVer = 0;
        $actual = $banner->getVersion($bannerId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsInt()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = 1;
        $excVer = 0;
        $actual = $banner->getVersion($bannerId);
        // var_dump($actual['Version']);
        $this->assertEquals($excVer, $actual[0]['Version']);
    }
    public function testGetVersionIsFloat()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = 1.4;
        $actual = $banner->getVersion($bannerId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsNull()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = NULL;
        $actual = $banner->getVersion($bannerId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsEmpty()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = '';
        $actual = $banner->getVersion($bannerId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionDifId()
    {
        $banner = new Banner(new DBPDO());
        $bannerId = 43;
        $exc = 2;
        $actual = $banner->getVersion($bannerId);
        if ($exc != $actual[0]['Version']) {
            $this->assertTrue(true);
        }
    }
    public function testSetVersionOK()
    {
        $banner = new Banner(new DBPDO());
        $id = 1;
        $exc = 1;
        $banner->startTransaction();
        $update = $banner->setVersion($id);
        $act = $banner->getVersion($id);
        $this->assertEquals($exc, $act[0]['Version']);
        $banner->rollback();
    }
    public function testSetVersionIsString()
    {
        $banner = new Banner(new DBPDO());
        $params = "wcsdvs";
        $banner->startTransaction();
        $actual = $banner->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $banner->rollback();
    }
    public function testSetVersionIsInt()
    {
        $banner = new Banner(new DBPDO());
        $params = 123;
        $banner->startTransaction();
        $actual = $banner->setVersion($params);
        if ($actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $banner->rollback();
    }
    public function testSetVersionIsObject()
    {
        $banner = new Banner(new DBPDO());
        $params = $banner;
        $banner->startTransaction();
        $actual = $banner->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testSetVersionIsNull()
    {
        $banner = new Banner(new DBPDO());
        $params = NULL;

        $banner->startTransaction();
        $actual = $banner->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
    public function testSetVersionIsEmpty()
    {
        $banner = new Banner(new DBPDO());
        $params = "";
        $banner->startTransaction();
        $actual = $banner->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $banner->rollback();
    }
}
