<?php


// use SmartWeb\DataBase\Product\Model;
// use SmartWeb\Models\Product;
use SmartWeb\Models\Category;
// use SmartWeb\Models\
use SmartWeb\Models\DBPDO;
use SmartWeb\Controller\CategoryController;
use SmartWeb\Models\CSRFToken;

use PHPUnit\Framework\TestCase;


class CategoryTest extends TestCase
{
    public function testInstance()
    {
        $category = Category::getInstance();
        $category1 =  Category::getInstance();

        $actual = false;
        if ($category === $category1) {
            $actual = true;
        }
        $expected = true;

        $this->assertEquals($expected, $actual);
    }
    public function testInstanceisOb()
    {
        $category = Category::getInstance();
        if (is_object($category)) {
            $this->assertTrue(True);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testInstanceNotNull()
    {
        $category = Category::getInstance();
        $actual = $category;
        if (empty($actual)) {
            $actual = false;
        } else {
            $actual = true;
        }
        $expected = true;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceCategoryModel()
    {
        $category = Category::getInstance();
        $actual = get_class($category);
        $expected = Category::class;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceAndCategoryModel()
    {
        $category = new Category(new DBPDO());

        $category1 = Category::getInstance();
        if ($category !== $category1) {
            $this->assertTrue(true);
        }
    }
    public function testGetCategoryListOK()
    {
        // var_dump($this);
        // $phone = new Phone();
        $category = new Category(new DBPDO());
        $exc = 6;
        $act = $category->getCategory();
        $this->assertEquals($exc, count($act));
    }

    public function testInsertOK()
    {
        $category = new Category(new DBPDO());
       
        $name = "ádasda";
        $position = "1";
        $params = ["CategoryName" => $name, "Position" => $position];
        $category->startTransaction();
        $category->insertOne($params);
        $this->assertEquals(7, count($category->getCategory()));
        $category->rollback();
    }
    public function testInsertIsString()
    {
        $category = new Category(new DBPDO());
        $params = "fasd";
        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testInsertIsInt()
    {
        $category = new Category(new DBPDO());
        $params = 123;
        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testInsertIsObject()
    {
        $category = new Category(new DBPDO());
        $params = $category;
        $category->startTransaction();
        $actual = $category->insertOne($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testInsertIsNull()
    {
        $category = new Category(new DBPDO());
        $params = null;
        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testInsertIsEmpty()
    {
        $category = new Category(new DBPDO());
        $params = "";
        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testInsertNameSQLInjection()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "','');TRUNCATE TABLE Category##','";
        $position = "1";
        //array.
        $params = ["CategoryName" => $name, "Position" => $position];

        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }

    public function testInsertPositionSQLInjection()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "sssdvs";
        $position = "');TRUNCATE TABLE Category##";
        //array.
        $params = ["CategoryName" => $name, "Position" => $position];

        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testInsertNameXSS()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $position = "1";
        //array.
        $params = ["CategoryName" => htmlentities($name), "Position" => $position];

        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testInsertPositionXSS()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "vsdv";
        $position = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        //array.
        $params = ["CategoryName" => $name, "Position" => htmlentities($position)];

        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testInsertNameCSRF()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "vsdv";
        $position = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        //array.
        $params = ["CategoryName" => $name, "Position" => htmlentities($position)];
        $category->startTransaction();
        $actual = $category->insertOne((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }


    public function testGetCategoryIdOK()
    {
        $category = new Category(new DBPDO());
        $categoryId = 9;
        $name = "Loa";
        $actual = $category->getOne($categoryId);
        $this->assertEquals($name, $actual[0]['CategoryName']);
    }
    public function testGetCategoryIdIsNull()
    {
        $category = new Category(new DBPDO());
        $categoryId = null;
        $actual = $category->getOne($categoryId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetCategoryIdIsString()
    {
        $category = new Category(new DBPDO());
        $categoryId = "alo";
        $actual = $category->getOne($categoryId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetCategoryIdIsNGId()
    {
        $category = new Category(new DBPDO());
        $categoryId = 8;
        $name = "Loa";
        $actual = $category->getOne($categoryId);
        if ($name != $actual[0]['CategoryName']) {
            $this->assertTrue(true);
        }
    }
    public function testGetCategoryIdIsEmpty()
    {
        $category = new Category(new DBPDO());
        $categoryId = '';
        $actual = $category->getOne($categoryId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetCategoryIdIsFloat()
    {
        $category = new Category(new DBPDO());
        $categoryId = 4.3;
        $actual = $category->getOne($categoryId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetCategoryIdIsSpecChar()
    {
        $category = new Category(new DBPDO());
        $categoryId = "$%^&*";
        $actual = $category->getOne($categoryId);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }

    public function testDeleteOK()
    {
        $category = new Category(new DBPDO());
        $categoryId = '10';
        $params = ["CategoryID" => $categoryId];
        $expected = true;
        $category->startTransaction();
        $actual = $category->deleteOne($params['CategoryID']);
        // var_dump($actual);
        $this->assertEquals($expected, $actual);
        $category->rollback();
    }
    public function testDeleteNG()
    {
        $category = new Category(new DBPDO());
        $categoryId = 9999;
        $params = ["CategoryID" => $categoryId];
        $category->startTransaction();
        $actual = $category->deleteOne($params['CategoryID']);
        // var_dump($actual);
        if (empty($actual)) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testDeleteIsFloat()
    {
        $category = new Category(new DBPDO());
        $categoryId = 43.6;
        $params = ["CategoryID" => $categoryId];
        $expected = false;
        $category->startTransaction();
        $actual = $category->deleteOne($params['CategoryID']);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $category->rollback();
    }
    public function testDeleteIsNull()
    {
        $category = new Category(new DBPDO());
        $categoryId = NULL;
        $params = ["CategoryID" => $categoryId];
        $expected = false;
        $category->startTransaction();
        $actual = $category->deleteOne($params['CategoryID']);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $category->rollback();
    }
    public function testDeleteIsString()
    {
        $category = new Category(new DBPDO());
        $categoryId = "casa";
        $params = ["CategoryID" => $categoryId];
        $expected = false;
        $category->startTransaction();
        $actual = $category->deleteOne($params['CategoryID']);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $category->rollback();
    }
    public function testDeleteIsSpecChar()
    {
        $category = new Category(new DBPDO());
        $categoryId = "%^&*";
        $params = ["CategoryID" => $categoryId];
        $expected = false;
        $category->startTransaction();
        $actual = $category->deleteOne($params['CategoryID']);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $category->rollback();
    }
    public function testDeleteIsEmpty()
    {
        $category = new Category(new DBPDO());
        $categoryId = "";
        $params = ["CategoryID" => $categoryId];
        $expected = false;
        $category->startTransaction();
        $actual = $category->deleteOne($params['CategoryID']);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $category->rollback();
    }
    public function testDeleteIsBool()
    {
        $category = new Category(new DBPDO());
        $categoryId = false;
        $params = ["CategoryID" => $categoryId];
        $expected = false;
        $category->startTransaction();
        $actual = $category->deleteOne($params['CategoryID']);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

        $category->rollback();
    }
    public function testUpdateOK()
    {
        $category = new Category(new DBPDO());
        $name = "ádasda";
        $position = "ádad";
        $id = 10;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];
        $category->startTransaction();
        $category->updateOne($params);
        $this->assertEquals(6, count($category->getCategory()));
        $category->rollback();
    }
    public function testUpdateIsString()
    {
        $category = new Category(new DBPDO());
        $params = "wcsdvs";
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $category->rollback();
    }
    public function testUpdateIsInt()
    {
        $category = new Category(new DBPDO());
        $params = 123;
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $category->rollback();
    }
    public function testUpdateIsObject()
    {
        $category = new Category(new DBPDO());
        $params = $category;
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testUpdateIsNull()
    {
        $category = new Category(new DBPDO());
        $params = NULL;

        $category->startTransaction();
        $actual = $category->updateOne($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testUpdateIsEmpty()
    {
        $category = new Category(new DBPDO());
        $params = "";
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testUpdateNameSQLInjection()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "','');TRUNCATE TABLE Category##','";
        $position = "ádad";
        $id = 10;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];

        $category->startTransaction();
        $actual = $category->updateOne($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }

    public function testUpdatePositionSQLInjection()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "sssdvs";
        $position = "');TRUNCATE TABLE Category##";
        $id = 10;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testUpdateNameXSS()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $position = "câcsdvds";
        $id = 10;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testUpdatePositionXSS()
    {
        $category = new Category(new DBPDO());
        //data.

        $name = "vsdv";
        $position = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $id = 10;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testUpdateVersionIDDOROK()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "vsdv";
        $position = "sdvs";
        $id = 10;
        $version =  0;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];

        $category->startTransaction();
        $ver = $category->getVersion($params['CategoryID']);
        // var_dump($ver['Version']);
        if ($ver[0]['Version'] == $version) {
            $actual = $category->updateOne($params);
            $category->setVersion($params['CategoryID']);
        }
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testUpdateVersionIDDORNG()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "vsdv";
        $position = "sdvs";
        $id = 10;
        $version =  3;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];
        (string)$expected = "Khong the update";
        (string)$actual = "";

        $ver = $category->getVersion($params['CategoryID']);
        // var_dump($ver['Version']);
        if ($ver[0]['Version'] != $version) {
            $actual = "Khong the update";
        }
        $this->assertEquals($expected, $actual);
    }
    public function testUpdateCSRF()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "vsdv";
        $position = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $id = 10;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = $token;
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testUpdateCSRFNG()
    {
        $category = new Category(new DBPDO());
        //data.
        $name = "vsdv";
        $position = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $id = 10;
        $token =  CSRFToken::GenerateToken();
        $_SESSION['Hash'] = "0";
        //array.
        $params = ["CategoryName" => $name, "Position" => $position, "CategoryID" => $id, "Hash" => $token];
        $category->startTransaction();
        $actual = $category->updateOne($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testGetVersionOK()
    {
        $category = new Category(new DBPDO());
        $categoryId = "9";
        $excVer = 0;
        $actual = $category->getVersion($categoryId);
        // var_dump($actual['Version']);
        $this->assertEquals($excVer, $actual[0]['Version']);
    }
    public function testGetVersionIsString()
    {
        $category = new Category(new DBPDO());
        $categoryId = "ac";
        $excVer = 0;
        $actual = $category->getVersion($categoryId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsInt()
    {
        $category = new Category(new DBPDO());
        $categoryId = 9;
        $excVer = 0;
        $actual = $category->getVersion($categoryId);
        // var_dump($actual['Version']);
        $this->assertEquals($excVer, $actual[0]['Version']);
    }
    public function testGetVersionIsFloat()
    {
        $category = new Category(new DBPDO());
        $categoryId = 1.4;
        $actual = $category->getVersion($categoryId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsNull()
    {
        $category = new Category(new DBPDO());
        $categoryId = NULL;
        $actual = $category->getVersion($categoryId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionIsEmpty()
    {
        $category = new Category(new DBPDO());
        $categoryId = '';
        $actual = $category->getVersion($categoryId);
        if (empty($actual)) {
            $this->assertTrue(true);
        }
    }
    public function testGetVersionDifId()
    {
        $category = new Category(new DBPDO());
        $categoryId = 10;
        $exc = 2;
        $actual = $category->getVersion($categoryId);
        if ($exc != $actual[0]['Version']) {
            $this->assertTrue(true);
        }
    }
    public function testSetVersionOK()
    {
        $category = new Category(new DBPDO());
        $id = 9;
        $exc = 1;
        $category->startTransaction();
        $update = $category->setVersion($id);
        $act = $category->getVersion($id);
        $this->assertEquals($exc, $act[0]['Version']);
        $category->rollback();
    }
    public function testSetVersionIsString()
    {
        $category = new Category(new DBPDO());
        $params = "wcsdvs";
        $category->startTransaction();
        $actual = $category->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $category->rollback();
    }
    public function testSetVersionIsInt()
    {
        $category = new Category(new DBPDO());
        $params = 123;
        $category->startTransaction();
        $actual = $category->setVersion($params);
        if ($actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $category->rollback();
    }
    public function testSetVersionIsObject()
    {
        $category = new Category(new DBPDO());
        $params = $category;
        $category->startTransaction();
        $actual = $category->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testSetVersionIsNull()
    {
        $category = new Category(new DBPDO());
        $params = NULL;

        $category->startTransaction();
        $actual = $category->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
    public function testSetVersionIsEmpty()
    {
        $category = new Category(new DBPDO());
        $params = "";
        $category->startTransaction();
        $actual = $category->setVersion($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $category->rollback();
    }
}
