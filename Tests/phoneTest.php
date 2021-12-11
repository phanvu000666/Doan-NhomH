<?php

use PHPUnit\Framework\TestCase;
use SmartWeb\Models\Phone;
use SmartWeb\Models\DBPDO;
use SmartWeb\Models\CSRFToken;

class PhoneTest extends TestCase
{
    public function testInstance()
    {
        $ban1 = Phone::getInstance();
        $ban2 =  Phone::getInstance();

        $actual = false;
        if ($ban1 === $ban2) {
            $actual = true;
        }
        $expected = true;

        $this->assertEquals($expected, $actual);
    }
    public function testInstanceisOb()
    {
        $ban = Phone::getInstance();
        if (is_object($ban)) {
            $this->assertTrue(True);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testInstanceNotNull()
    {
        $ban = Phone::getInstance();
        $actual = $ban;
        if (empty($actual)) {
            $actual = false;
        } else {
            $actual = true;
        }
        $expected = true;
        $this->assertEquals($expected, $actual);
    }
    public function testInstancePhoneModel()
    {
        $ban = Phone::getInstance();
        $actual = get_class($ban);
        $expected = Phone::class;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceAndPhoneModel()
    {
        $ban = new Phone(new DBPDO());

        $ban2 = Phone::getInstance();
        if ($ban !== $ban2) {
            $this->assertTrue(true);
        }
    }
    public function testGetPhoneListOK()
    {
        // var_dump($this);
        // $phone = new Phone();
        $phone = new Phone(new DBPDO());
        $exc = 11;
        $act = $phone->getPhone();
        $this->assertEquals($exc, count($act));
    }

    public function testInsertOK()
    {
        $phone = new Phone(new DBPDO());
        $productName = "San pham 1";
        $categoryID = "1";
        $manufactureID = "1";
        $params = ["ProductName" => $productName, "CategoryID" => $categoryID, "ManufacturerID" => $manufactureID];

        $phone->startTransaction();
        $phone->insert($params);
        $this->assertEquals(12, count($phone->getPhone()));
        $phone->rollback();
    }
    public function testInsertIsString()
    {
        $phone = new Phone(new DBPDO());
        $params = "fasd";
        $phone->startTransaction();
        $actual = $phone->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testInsertIsInt()
    {
        $phone = new Phone(new DBPDO());
        $params = 123;
        $phone->startTransaction();
        $actual = $phone->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testInsertIsObject()
    {
        $phone = new Phone(new DBPDO());
        $params = $phone;
        $phone->startTransaction();
        $actual = $phone->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testInsertIsNull()
    {
        $phone = new Phone(new DBPDO());
        $params = null;
        $phone->startTransaction();
        $actual = $phone->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testInsertIsEmpty()
    {
        $phone = new Phone(new DBPDO());
        $params = "";
        $phone->startTransaction();
        $actual = $phone->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }

    public function testInsertNameSQLInjection()
    {
        $phone = new Phone(new DBPDO());
        //data.
        $ProductName = "test', 2, 2);TRUNCATE TABLE Phone##";
        $categoryID  = 2;
        $manufactureID = 3;
        //array.
        $params = ["ProductName" => $ProductName, "CategoryID" => $categoryID, "ManufacturerID" => $manufactureID];

        $phone->startTransaction();
        $actual = $phone->insert($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testInsertNameXSS()
    {
        $phone = new Phone(new DBPDO());
        //data.
        $image = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $cate = "3";
        $manu = "3";
        //array.
        $params = ["ProductName" => $image, "CategoryID" => htmlentities($cate), "ManufacturerID" => $manu];

        $phone->startTransaction();
        $actual = $phone->insert((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testGetPhoneIdOK()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = 40;
        $expected = "iPhone 7 Plus 32GB";
        $actual = $phone->getProductID($phoneId);
        $this->assertEquals($expected, $actual[0]['ProductName']);
    }
    public function testGetPhoneIdIsNull()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = null;
        // $excImg = "h4-slide.png";
        $actual = $phone->getProductID($phoneId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetPhoneIdIsString()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = "alo";
        // $excImg = "h4-slide.png";
        $actual = $phone->getProductID($phoneId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetPhoneIdIsNGId()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = 40;
        $expected = "h4-slide";
        $actual = $phone->getProductID($phoneId);
        // var_dump($actual);
        // $this->assertEquals($excImg, $actual[0]['PhoneImage']);
        if ($expected != $actual[0]['ProductName']) {
            $this->assertTrue(true);
        }
    }
    public function testGetPhoneIdIsEmpty()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = '';
        // $excImg = "h4-slide.png";
        $actual = $phone->getProductID($phoneId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetPhoneIdIsFloat()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = 4.3;
        // $excImg = "h4-slide.png";
        $actual = $phone->getProductID($phoneId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetPhoneIdIsSpecChar()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = "$%^&*";
        // $excImg = "h4-slide.png";
        $actual = $phone->getProductID($phoneId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }

    public function testDeleteOK()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = '44';
       
        $expected = true;
        $phone->startTransaction();
        $actual = $phone->delete((int)$phoneId);
        // var_dump($actual);
        $this->assertEquals($expected, $actual);
        $phone->rollback();
    }
    public function testDeleteNG()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = 9999;
        $phone->startTransaction();
        $actual = $phone->delete($phoneId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testDeleteIsFloat()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = 43.6;
        $expected = false;
        $phone->startTransaction();
        $actual = $phone->delete($phoneId);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(true);
        } 

        $phone->rollback();
    }
    public function testDeleteIsNull()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = NULL;
        $expected = false;
        $phone->startTransaction();
        $actual = $phone->delete($phoneId);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(true);
        }

        $phone->rollback();
    }
    public function testDeleteIsString()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = "casa";

        $phone->startTransaction();
        $actual = $phone->delete($phoneId);
        // var_dump($actual);
        if (!$actual) {
            $this->assertTrue(true);
        }

        $phone->rollback();
    }
    public function testDeleteIsSpecChar()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = "%^&*";
        $phone->startTransaction();
        $actual = $phone->delete($phoneId);
        // var_dump($actual);
        if (!$actual) {
            $this->assertTrue(true);
        }

        $phone->rollback();
    }
    public function testDeleteIsEmpty()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = "";
        $phone->startTransaction();
        $actual = $phone->delete($phoneId);
        // var_dump($actual);
        if (!$actual) {
            $this->assertTrue(true);
        }

        $phone->rollback();
    }
    public function testDeleteIsBool()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = false;

        $phone->startTransaction();
        $actual = $phone->delete($phoneId);
        // var_dump($actual);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testUpdateOK()
    {
        $phone = new Phone(new DBPDO());
        $name = "âfasd";
        $cate = "3";
        $manu = "3";
        $id = 44;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ProductName" => $name, "CategoryID" => $cate, "ManufacturerID" => $manu, "ProductID" => $id, "Hash" => $token];
        $phone->startTransaction();
        $phone->update($params);

        $this->assertEquals(9, count($phone->getProduct()));
        $phone->rollback();
    }

    public function testUpdateIsString()
    {
        $phone = new Phone(new DBPDO());
        $params = "23wcsdvs";
        $phone->startTransaction();
        $actual = $phone->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $phone->rollback();
    }
    public function testUpdateIsInt()
    {
        $phone = new Phone(new DBPDO());
        $params = 123;
        $phone->startTransaction();
        $actual = $phone->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $phone->rollback();
    }
    public function testUpdateIsObject()
    {
        $phone = new Phone(new DBPDO());
        $params = $phone;
        $phone->startTransaction();
        $actual = $phone->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testUpdateIsNull()
    {
        $phone = new Phone(new DBPDO());
        $params = NULL;

        $phone->startTransaction();
        $actual = $phone->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testUpdateIsEmpty()
    {
        $phone = new Phone(new DBPDO());
        $params = "";
        $phone->startTransaction();
        $actual = $phone->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }

    public function testUpdateNameXSS()
    {
        $phone = new Phone(new DBPDO());
        //data.

        $name = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $cate = "3";
        $manu = "3";
        $id = 44;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ProductName" => htmlentities($name) , "CategoryID" => $cate, "ManufacturerID" => $manu, "ProductID" => $id, "Hash" => $token];
        
        $phone->startTransaction();
        $actual = $phone->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }

    public function testUpdateVersionIDDOROK()
    {
        $phone = new Phone(new DBPDO());
        //data
        //array.
        $phone = new Phone(new DBPDO());
        $name = "âfasd";
        $cate = "3";
        $manu = "3";
        $id = 40;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ProductName" => $name, "CategoryID" => $cate, "ManufacturerID" => $manu, "ProductID" => $id, "Hash" => $token];
        $version = 0;

        $phone->startTransaction();
        $ver = $phone->getVersion((int)$params['ProductID']);
        // var_dump($ver['Version']);
        if ((int)$ver["Version"] === $version) {
            $actual = $phone->update($params);
            $phone->setVersion($params['ProductID']);
          
        }
        if ($actual) {
            $this->assertTrue(true);
        }
        
        $phone->rollback();
    }
    public function testUpdateVersionIDDORNG()
    {
        $phone = new Phone(new DBPDO());
        //data
        //array.
        $phone = new Phone(new DBPDO());
        $name = "âfasd";
        $cate = "3";
        $manu = "3";
        $id = 40;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ProductName" => $name, "CategoryID" => $cate, "ManufacturerID" => $manu, "ProductID" => $id, "Hash" => $token];
        $version = 1;

        $phone->startTransaction();
        $ver = $phone->getVersion($params['ProductID']);
        // var_dump($ver['Version']);
        if ($ver['Version'] !== $version) {
            $this->assertTrue(true);
        }

        $phone->rollback();
    }
    public function testUpdateCSRF()
    {
        $phone = new Phone(new DBPDO());
        //data.

        $name = "âfasd";
        $cate = "3";
        $manu = "3";
        $id = 44;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ProductName" => $name, "CategoryID" => $cate, "ManufacturerID" => $manu, "ProductID" => $id, "Hash" => $token];

        $phone->startTransaction();
        $actual = $phone->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testUpdateCSRFNG()
    {
        $phone = new Phone(new DBPDO());
        //data.
        $name = "âfasd";
        $cate = "3";
        $manu = "3";
        $id = 44;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["ProductName" => $name, "CategoryID" => $cate, "ManufacturerID" => $manu, "ProductID" => $id, "Hash" => $token];
        $_SESSION['Hash'] = "0";
        $phone->startTransaction();
        $actual = $phone->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testGetVersionOK()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = 40;
        $excVer = 0;
        $actual = $phone->getVersion($phoneId);
        // var_dump($actual['Version']);
        $this->assertEquals($excVer, $actual['Version']);
    }
    public function testGetVersionIsString()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = "ac";
        $actual = $phone->getVersion($phoneId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsInt()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = 40;
        $excVer = 0;
        $actual = $phone->getVersion($phoneId);
        // var_dump($actual['Version']);
        $this->assertEquals($excVer, $actual['Version']);
    }
    public function testGetVersionIsFloat()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = 1.4;
        $actual = $phone->getVersion($phoneId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsNull()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = NULL;
        $actual = $phone->getVersion($phoneId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsEmpty()
    {
        $phone = new Phone(new DBPDO());
        $phoneId = '';
        $actual = $phone->getVersion($phoneId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionDifId()
    {
        $phone = new Phone(new DBPDO());
        $phoneId =36;
        $exc = 0;
        $actual = $phone->getVersion($phoneId);
        if ($exc != $actual['Version']) {
            $this->assertTrue(true);
        }
    }
    public function testSetVersionOK()
    {
        $phone = new Phone(new DBPDO());
        $id = 40;
        $exc = 1;
        $phone->startTransaction();
        $update = $phone->setVersion($id);
        $act = $phone->getVersion($id);
        $this->assertEquals($exc, $act['Version']);
        $phone->rollback();
    }
    public function testSetVersionIsString()
    {
        $phone = new Phone(new DBPDO());
        $params = "wcsdvs";
        $phone->startTransaction();
        $actual = $phone->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $phone->rollback();
    }
    public function testSetVersionIsInt()
    {
        $phone = new Phone(new DBPDO());
        $params = 123;
        $phone->startTransaction();
        $actual = $phone->setVersion($params);
        if ($actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $phone->rollback();
    }
    public function testSetVersionIsObject()
    {
        $phone = new Phone(new DBPDO());
        $params = $phone;
        $phone->startTransaction();
        $actual = $phone->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testSetVersionIsNull()
    {
        $phone = new Phone(new DBPDO());
        $params = NULL;

        $phone->startTransaction();
        $actual = $phone->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testSetVersionIsEmpty()
    {
        $phone = new Phone(new DBPDO());
        $params = "";
        $phone->startTransaction();
        $actual = $phone->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $phone->rollback();
    }
    public function testGetMaxID()
    {
        $phone = new Phone(new DBPDO());
        $actual =  $phone->getMaxID();
        if(array($actual) )
        {
            $this->assertTrue(true);
        }
    }
}
