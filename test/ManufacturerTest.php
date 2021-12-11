<?php


// use SmartWeb\DataBase\Product\Model;
// use SmartWeb\Models\Product;
use SmartWeb\Models\Manufacture;
// use SmartWeb\Models\
use SmartWeb\Models\DBPDO;
use SmartWeb\Controller\ManufactureController;
use SmartWeb\Models\CSRFToken;

use PHPUnit\Framework\TestCase;


class ManufacturerTest extends TestCase
{
    public function testInstance()
    {
        $manu1 = Manufacture::getInstance();
        $manu2 =  Manufacture::getInstance();

        $actual = false;
        if ($manu1 === $manu2) {
            $actual = true;
        }
        $expected = true;

        $this->assertEquals($expected, $actual);
    }
    public function testInstanceisOb()
    {
        $manu = Manufacture::getInstance();
        if (is_object($manu)) {
            $this->assertTrue(True);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testInstanceNotNull()
    {
        $manu = Manufacture::getInstance();
        $actual = $manu;
        if (empty($actual)) {
            $actual = false;
        } else {
            $actual = true;
        }
        $expected = true;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceManuModel()
    {
        $manu = Manufacture::getInstance();
        $actual = get_class($manu);
        $expected = Manufacture::class;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceAndManuModel()
    {
        $manu = new Manufacture(new DBPDO());

        $manu2 = Manufacture::getInstance();
        if ($manu !== $manu2) {
            $this->assertTrue(true);
        }
    }
    public function testGetManuListOK()
    {
        // var_dump($this);
        // $phone = new Phone();
        $manu = new Manufacture(new DBPDO());
        $exc = 11;
        $act = $manu->getManu();
        $this->assertEquals($exc, count($act));
    }
    public function testInsertOK()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_name = "Black Shark";
        $exc = 11;
        $params = ["ManufacturerName" => $manu_name];
        $manu->startTransaction();
        $manu->insert($params);
        $this->assertEquals($exc, count($manu->getManu()));
        $manu->rollback();
    }
    public function testInsertIsString()
    {
        $manu = new Manufacture(new DBPDO());
        $params = "fasd";
        $manu->startTransaction();
        $actual = $manu->insert((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testInsertIsInt()
    {
        $manu = new Manufacture(new DBPDO());
        $params = 123;
        $manu->startTransaction();
        $actual = $manu->insert((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testInsertIsObject()
    {
        $manu = new Manufacture(new DBPDO());
        $params = $manu;
        $manu->startTransaction();
        $actual = $manu->insert((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testInsertIsNull()
    {
        $manu = new Manufacture(new DBPDO());
        $params = null;
        $manu->startTransaction();
        $actual = $manu->insert((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testInsertIsEmpty()
    {
        $manu = new Manufacture(new DBPDO());
        $params = "";
        $manu->startTransaction();
        $actual = $manu->insert((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
// // OK! Rủi ro!
    // public function testInsertManuNameSQLInjection()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     //data.
    //     $manu_name = "ROG 5";
    //     //array.
    //     $params = ["ManufacturerName" => $manu_name];
    //     $manu->startTransaction();
    //     $actual = $manu->insert((array)$params);
    //     if ($actual) {
    //         $this->assertTrue(false);
    //     }
    //     $manu->rollback();
    // }
    // public function testInsertManuNameXSS()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     //data.
    //     $manu_name = "ROG 5";
    //     //array.
    //     $params = ["ManufacturerName" => $manu_name];

    //     $manu->startTransaction();
    //     $actual = $manu->insert((array)$params);
    //     if ($actual) {
    //         $this->assertTrue(true);
    //     }
    //     $manu->rollback();
    // }
    // public function testInsertManuNameCSRF()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     //data.
    //     $manu_name = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
    //     //array.
    //     $params = ["ManufacturerName" => htmlentities($manu_name)];

    //     $manu->startTransaction();
    //     $actual = $manu->insert((array)$params);
    //     if ($actual) {
    //         $this->assertTrue(true);
    //     }
    //     $manu->rollback();
    // }

    public function testGetManufacturerIdOK()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = 14;
        $manu_name = "Asus";
        $actual = $manu->getManuID($manu_id);
        $this->assertEquals($manu_name, $actual[0]['ManufacturerName']);
    }
    public function testGetManufacturerIdNull()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = null;
        // $manu_name = "Asus";
        $actual = $manu->getManuID($manu_id);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetManufacturerIdIsString()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = "14";
        // $manu_name = "Asus";
        $actual = $manu->getManuID($manu_id);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetManufacturerIdIsNGId()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = 14;
        $manu_name = "Asuss";
        $actual = $manu->getManuID($manu_id);
        // var_dump($actual);
        // $this->assertEquals($manu_name, $actual[0]['manu_name']);
        if ($manu_name != $actual[0]['ManufacturerName']) {
            $this->assertTrue(true);
        }
    }
    public function testGetManufacturerIdIsEmpty()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = '';
        // $manu_name = "Asuss";
        $actual = $manu->getManuID($manu_id);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetManufacturerIdIsFloat()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = 4.3;
        // $manu_name = "Asuss";
        $actual = $manu->getManuID($manu_id);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetManufacturerIdIsSpecChar()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = "$%^&*";
        // $manu_name = "Asuss";
        $actual = $manu->getManuID($manu_id);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
// rollback() chưa trả về giá trị cũ.
    // public function testDeleteManuOK()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     $manu_id = '14';
    //     $params = ["ManufacturerID" => $manu_id];
    //     $expected = true;
    //     $manu->startTransaction();
    //     $actual = $manu->delete($params);
    //     // var_dump($actual);
    //     $this->assertEquals($expected, $actual);
    //     $manu->rollback();
    // }
    public function testDeleteManuNG()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = 9999;
        $params = ["ManufacturerID" => $manu_id];
        $manu->startTransaction();
        $actual = $manu->delete($params);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testDeleteManuIsFloat()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = 18.9;
        $params = ["ManufacturerID" => $manu_id];
        $expected = false;
        $manu->startTransaction();
        $actual = $manu->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $manu->rollback();
    }
    public function testDeleteManuIsNull()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = NULL;
        $params = ["ManufacturerID" => $manu_id];
        $expected = false;
        $manu->startTransaction();
        $actual = $manu->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $manu->rollback();
    }
    public function testDeleteIsString()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = "alo";
        $params = ["ManufacturerID" => $manu_id];
        $expected = false;
        $manu->startTransaction();
        $actual = $manu->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $manu->rollback();
    }
    public function testDeleteManuIsSpecChar()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = "%^&*";
        $params = ["ManufacturerID" => $manu_id];
        $expected = false;
        $manu->startTransaction();
        $actual = $manu->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $manu->rollback();
    }
    public function testDeleteManuIsEmpty()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = " ";
        $params = ["ManufacturerID" => $manu_id];
        $expected = false;
        $manu->startTransaction();
        $actual = $manu->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $manu->rollback();
    }
    public function testDeleteManuIsBool()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = false;
        $params = ["ManufacturerID" => $manu_id];
        $expected = false;
        $manu->startTransaction();
        $actual = $manu->delete($params);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $manu->rollback();
    }

    public function testUpdateManuOK()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_name = "Huawei";
        $manu_id = 15;
        $version = null;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ManufacturerName" => $manu_name,"Version" => $version,"ManufacturerID" => $manu_id, "Hash" => $token];
        $manu->startTransaction();
        $manu->update($params);
        $this->assertEquals(11, count($manu->getManu()));
        $manu->rollback();
    }

    public function testUpdateManuIsString()
    {
        $manu = new Manufacture(new DBPDO());
        $params = "23wcsdvs";
        $manu->startTransaction();
        $actual = $manu->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $manu->rollback();
    }
    public function  testUpdateManuIsInt()
    {
        $manu = new Manufacture(new DBPDO());
        $params = 123;
        $manu->startTransaction();
        $actual = $manu->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $manu->rollback();
    }
    public function  testUpdateManuIsObject()
    {
        $manu = new Manufacture(new DBPDO());
        $params = $manu;
        $manu->startTransaction();
        $actual = $manu->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testUpdateIsNull()
    {
        $manu = new Manufacture(new DBPDO());
        $params = NULL;

        $manu->startTransaction();
        $actual = $manu->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testUpdateIsEmpty()
    {
        $manu = new Manufacture(new DBPDO());
        $params = "";
        $manu->startTransaction();
        $actual = $manu->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testUpdateManu_NameSQLInjection()
    {
        $manu = new Manufacture(new DBPDO());
        //data.
        $manu_name = "CC";
        $manu_id = 16;
        $version = null;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ManufacturerName" => $manu_name,"Version" => $version,"ManufacturerID" => $manu_id, "Hash" => $token];

        $manu->startTransaction();
        $actual = $manu->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }

    public function testUpdateManuNameXSS()
    {
        $manu = new Manufacture(new DBPDO());
        //data.
        $manu_name = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $manu_id = 16;
        $version = null;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ManufacturerName" => $manu_name,"Version" => $version,"ManufacturerID" => $manu_id, "Hash" => $token];
        $manu->startTransaction();
        $actual = $manu->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
//Lỗi
    // public function testUpdateVersionIDDOROK()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     //data.
    //     $manu_name = "CC";
    //     $manu_id = 17;
    //     $version = 2;
    //     $token =  CSRFToken::GenerateToken();
    //     $_SESSION['Hash'] = $token;
    //     //array.
    //     $params = ["ManufacturerName" => $manu_name,"Version" => $version,"ManufacturerID" => $manu_id, "Hash" => $token];

    //     $manu->startTransaction();
    //     $ver = $manu->getVersion($params['ManufacturerID']);
    //     // var_dump($ver['Version']);
    //     if ($ver[0]['Version'] == $version) {
    //         $actual = $manu->update($params);
    //         $manu->setVersion($params['ManufacturerID']);
    //     }
    //     if ($actual) {
    //         $this->assertTrue(true);
    //     }
    //     $manu->rollback();
    // }
//Rủi ro
    // public function testUpdateVersionIDDORNG()
    // {
    //    $manu = new Manufacture(new DBPDO());
    //     //data.
    //     $manu_name = "CC";
    //     $manu_id = 17;
    //     $version = 3;
    //     $token =  CSRFToken::GenerateToken();
    //     $_SESSION['Hash'] = $token;
    //     //array.
    //     $params = ["ManufacturerName" => $manu_name,"Version" => $version,"ManufacturerID" => $manu_id, "Hash" => $token];
    //     (string)$expected = "Khong the update";
    //     (string)$actual = "";

    //     $ver = $manu->getVersion($params['ManufacturerID']);
    //     // var_dump($ver['Version']);
    //     if ($ver[0]['Version'] != $version) {
    //         $actual = "Khong the update";
    //         $this->assertEquals($expected, $actual);
    //     }
       
    // }
    public function testUpdateCSRF()
    {
        $manu = new Manufacture(new DBPDO());
        //data.
        $manu_name = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $manu_id = 17;
        $version = 3;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ManufacturerName" => htmlentities($manu_name),"Version" => $version,"ManufacturerID" => $manu_id, "Hash" => $token];

        $manu->startTransaction();
        $actual = $manu->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testUpdateCSRFNG()
    {
        $manu = new Manufacture(new DBPDO());
        //data.
        $manu_name = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $manu_id = 17;
        $version = 3;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = "0";
        //array.
        $params = ["ManufacturerName" => htmlentities($manu_name),"Version" => $version,"ManufacturerID" => $manu_id, "Hash" => $token];

        $manu->startTransaction();
        $actual = $manu->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $manu->rollback();
    }
    public function testGetVersionOK()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = "14";
        $excVer = 0;
        $actual = $manu->getVersion($manu_id);
        // var_dump($actual['Version']);
        $this->assertEquals($excVer, $actual[0]['Version']);
    }
//Rủi ro
    // public function testGetVersionIsString()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     $manu_id = "14";
    //     $excVer = 0;
    //     $actual = $manu->getVersion($manu_id);
    //     if (empty($actual)) {
    //         $this->assertTrue(true);
    //     }
    // }
    public function testGetVersionIsInt()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = 14;
        $excVer = 0;
        $actual = $manu->getVersion($manu_id);
        // var_dump($actual['Version']);
        $this->assertEquals($excVer, $actual[0]['Version']);
    }
    public function testGetVersionIsFloat()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = 1.4;
        $excVer = 0;
        $actual = $manu->getVersion($manu_id);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsNull()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = NULL;
        $actual = $manu->getVersion($manu_id);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsEmpty()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = "";
        $actual = $manu->getVersion($manu_id);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionDifId()
    {
        $manu = new Manufacture(new DBPDO());
        $manu_id = 17;
        $exc = 1;
        $actual = $manu->getVersion($manu_id);
        if ($exc != $actual[0]['Version']) {
            $this->assertTrue(true);
        }
    }
//Lỗi hàm SetVersion();
    // public function testSetVersionOK()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     $id = 11;
    //     $exc = 11;
    //     $manu->startTransaction();
    //     $update = $manu->setVersion($id);
    //     $act = $manu->getVersion($id);
    //     $this->assertEquals($exc, $act[0]['Version']);
    //     $manu->rollback();
    // }
    // public function testSetVersionIsString()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     $params = "wcsdvs";
    //     $manu->startTransaction();
    //     $actual = $manu->setVersion($params);
    //     if (!$actual) {
    //         $this->assertTrue(true);
    //     } else {
    //         $this->assertTrue(false);
    //     }
    //     $manu->rollback();
    // }
    // public function testSetVersionIsInt()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     $params = 123;
    //     $banner->startTransaction();
    //     $actual = $banner->setVersion($params);
    //     if ($actual) {
    //         $this->assertTrue(true);
    //     } else {
    //         $this->assertTrue(false);
    //     }
    //     $banner->rollback();
    // }
    // public function testSetVersionIsObject()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     $params = $banner;
    //     $banner->startTransaction();
    //     $actual = $banner->setVersion($params);
    //     if (!$actual) {
    //         $this->assertTrue(true);
    //     }
    //     $banner->rollback();
    // }
    // public function testSetVersionIsNull()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     $params = NULL;

    //     $banner->startTransaction();
    //     $actual = $banner->setVersion($params);
    //     if (!$actual) {
    //         $this->assertTrue(true);
    //     }
    //     $banner->rollback();
    // }
    // public function testSetVersionIsEmpty()
    // {
    //     $manu = new Manufacture(new DBPDO());
    //     $params = "";
    //     $banner->startTransaction();
    //     $actual = $banner->setVersion($params);
    //     if (!$actual) {
    //         $this->assertTrue(true);
    //     }
    //     $banner->rollback();
    // }
}
