<?php

use PHPUnit\Framework\TestCase;
use SmartWeb\Models\Property;
use SmartWeb\Models\DBPDO;

class PropertyTest extends TestCase
{
    public function testInstance()
    {
        $ban1 = Property::getInstance(new DBPDO);
        $ban2 =  Property::getInstance(new DBPDO);

        $actual = false;
        if ($ban1 === $ban2) {
            $actual = true;
        }
        $expected = true;

        $this->assertEquals($expected, $actual);
    }
    public function testInstanceisOb()
    {
        $ban = Property::getInstance(new DBPDO);
        if (is_object($ban)) {
            $this->assertTrue(True);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testInstanceNotNull()
    {
        $ban = Property::getInstance(new DBPDO);
        $actual = $ban;
        if (empty($actual)) {
            $actual = false;
        } else {
            $actual = true;
        }
        $expected = true;
        $this->assertEquals($expected, $actual);
    }
    public function testInstancePropertyModel()
    {
        $ban = Property::getInstance(new DBPDO);
        $actual = get_class($ban);
        $expected = Property::class;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceAndPropertyModel()
    {
        $ban = new Property(new DBPDO());

        $ban2 = Property::getInstance(new DBPDO);
        if ($ban !== $ban2) {
            $this->assertTrue(true);
        }
    }

    public function testInsertOK()
    {
        $property = new Property(new DBPDO());

        $ProductID = "100";
        $ImageUrl = "F:\github\Doan-NhomH\pictures\Upload\1110mcith_00000000000Nokia_6303i_b.jpg";
        $Description = "Thien gap ma.";
        $Quantity = 21;
        $Price = 345;
        $params = [
            "ProductID" => $ProductID,
            "ImageUrl" => $ImageUrl,
            "Price" => $Price,
            "Quantity" => $Quantity,
            "Description" => $Description
        ];
        $property->startTransaction();
        $property->insert($params);
        $this->assertEquals(11, count($property->getPropertyList()));
        $property->rollback();
    }
    public function testInsertIsString()
    {
        $property = new Property(new DBPDO());
        $params = "fasd";
        $property->startTransaction();
        $actual = $property->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testInsertIsInt()
    {
        $property = new Property(new DBPDO());
        $params = 123;
        $property->startTransaction();
        $actual = $property->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testInsertIsObject()
    {
        $property = new Property(new DBPDO());
        $params = $property;
        $property->startTransaction();
        $actual = $property->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testInsertIsNull()
    {
        $property = new Property(new DBPDO());
        $params = null;
        $property->startTransaction();
        $actual = $property->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testInsertIsEmpty()
    {
        $property = new Property(new DBPDO());
        $params = "";
        $property->startTransaction();
        $actual = $property->insert($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }

    public function testInsertImageOK()
    {
       // $property = new Property(new DBPDO());

        //$ProductID = "100";
        $ImageUrl = "F:/github/Doan-NhomH/pictures/Upload/1110mcith_00000000000Nokia_6303i_b.jpg";
        // $Description = "Thien gap ma.";
        // $Quantity = 21;
        // $Price = 345;
        // $params = [
        //     "ProductID" => $ProductID,
        //     "ImageUrl" => $ImageUrl,
        //     "Price" => $Price,
        //     "Quantity" => $Quantity,
        //     "Description" => $Description
        // ];
        //permitted
        $permitted = [
            'image/gif',
            'image/jpeg',
            'image/pjeg',
            'image/png',
            'image/webp'
        ];
        $getImage = getImageSize($ImageUrl);
        if (in_array($getImage["mime"], $permitted)) {
            $this->assertTrue(true);
        }
    }
    public function testInsertImageNGDifType()
    {
        //data.
        $image = "F:/github/Doan-NhomH/Tests/phoneTest.php";
     
        //array.
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
    public function testInsertDescriptionSQLInjection()
    {
        //$subTitle = "');TRUNCATE TABLE Property##";
        $property = new Property(new DBPDO());

        $ProductID = "100";
        $ImageUrl = "F:/github/Doan-NhomH/pictures/Upload/1110mcith_00000000000Nokia_6303i_b.jpg";
        $Description = "100','sdfasdf');TRUNCATE TABLE Property##";
        $Quantity = 21;
        $Price = 345;
        $params = [
            "ProductID" => $ProductID,
            "ImageUrl" => $ImageUrl,
            "Price" => $Price,
            "Quantity" => $Quantity,
            "Description" => $Description
        ];

        $property->startTransaction();
        $actual = $property->insert((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testInsertDescriptionXSS()
    {
        $property = new Property(new DBPDO());

        $ProductID = "100";
        $ImageUrl = "F:/github/Doan-NhomH/pictures/Upload/1110mcith_00000000000Nokia_6303i_b.jpg";
        $Description = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $Quantity = 21;
        $Price = 345;
        $params = [
            "ProductID" => $ProductID,
            "ImageUrl" => $ImageUrl,
            "Price" => $Price,
            "Quantity" => $Quantity,
            "Description" => htmlentities($Description) 
        ];
        $property->startTransaction();
        $actual = $property->insert((array)$params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testDeleteOK()
    {
        $property = new Property(new DBPDO());
        $ProductID = 44;
    
        $property->startTransaction();
        $expected = true;
        $actual = $property->delete($ProductID);
        // var_dump($actual);
        $this->assertEquals($expected, $actual);
        $property->rollback();
    }
    public function testDeleteNG()
    {
        $property = new Property(new DBPDO());
        $ProductID = 9999;
        $property->startTransaction();
        $property->delete($ProductID);
        // var_dump($actual);
        $actual = count($property->getPropertyList());
        $expected = 8;
        if($expected == $actual)
        {
            $this->assertTrue(false);
        }
        else{
            $this->assertTrue(true);
        }
      
        $property->rollback();
    }
    public function testDeleteIsFloat()
    {
        $property = new Property(new DBPDO());
        $propertyId = 43.6;
       
        $expected = false;
        $property->startTransaction();
        $actual = $property->delete($propertyId);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        $property->rollback();
    }
    public function testDeleteIsNull()
    {
        $property = new Property(new DBPDO());
        $propertyId = NULL;
        $expected = false;
        $property->startTransaction();
        $actual = $property->delete($propertyId);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        $property->rollback();
    }
    public function testDeleteIsString()
    {
        $property = new Property(new DBPDO());
        $propertyId = "casa";
        $expected = false;
        $property->startTransaction();
        $actual = $property->delete($propertyId);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        $property->rollback();
    }
    public function testDeleteIsSpecChar()
    {
        $property = new Property(new DBPDO());
        $propertyId = "%^&*";
        $expected = false;
        $property->startTransaction();
        $actual = $property->delete($propertyId);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        $property->rollback();
    }
    public function testDeleteIsEmpty()
    {
        $property = new Property(new DBPDO());
        $propertyId = "";
        $expected = false;
        $property->startTransaction();
        $actual = $property->delete($propertyId);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        $property->rollback();
    }
    public function testDeleteIsBool()
    {
        $property = new Property(new DBPDO());
        $propertyId = false;
        $expected = false;
        $property->startTransaction();
        $actual = $property->delete($propertyId);
        // var_dump($actual);
        if ($actual == $expected) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

        $property->rollback();
    }
    public function testUpdateOK()
    {
        $property = new Property(new DBPDO());

        $ProductID = "43";
        $ImageUrl = "F:/github/Doan-NhomH/pictures/Upload/1110mcith_00000000000Nokia_6303i_b.jpg";
        $Description = "100','sdfasdf');TRUNCATE TABLE Property##";
        $Quantity = 21;
        $Price = 345;
        $params = [
            "ProductID" => $ProductID,
            "ImageUrl" => $ImageUrl,
            "Price" => $Price,
            "Quantity" => $Quantity,
            "Description" => $Description
        ];
        $property->startTransaction();
        $property->update($params);
        $this->assertEquals(10, count($property->getPropertyList()));
        $property->rollback();
    }
    public function testUpdateOKWithoutImg()
    {
        $property = new Property(new DBPDO());
        $ProductID = "43";
        $Description = "100','sdfasdf');TRUNCATE TABLE Property##";
        $Quantity = 21;
        $Price = 345;
        $params = [
            "ProductID" => $ProductID,
            "Price" => $Price,
            "Quantity" => $Quantity,
            "Description" => $Description
        ];
        $property->startTransaction();
        $property->update($params);
        $this->assertEquals(10, count($property->getPropertyList()));
        $property->rollback();
    }
    public function testUpdateIsString()
    {
        $property = new Property(new DBPDO());
        $params = "wcsdvs";
        $property->startTransaction();
        $actual = $property->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $property->rollback();
    }
    public function testUpdateIsInt()
    {
        $property = new Property(new DBPDO());
        $params = 123;
        $property->startTransaction();
        $actual = $property->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
        $property->rollback();
    }
    public function testUpdateIsObject()
    {
        $property = new Property(new DBPDO());
        $params = $property;
        $property->startTransaction();
        $actual = $property->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testUpdateIsNull()
    {
        $property = new Property(new DBPDO());
        $params = NULL;

        $property->startTransaction();
        $actual = $property->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testUpdateIsEmpty()
    {
        $property = new Property(new DBPDO());
        $params = "";
        $property->startTransaction();
        $actual = $property->update($params);
        if (!$actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
    public function testUpdateTitleSQLInjection()
    {
        $property = new Property(new DBPDO());
        //data.
        $ProductID = "43";
        $ImageUrl = "F:/github/Doan-NhomH/pictures/Upload/1110mcith_00000000000Nokia_6303i_b.jpg";
        $Description = "100','sdfasdf');TRUNCATE TABLE Property##";
        $Quantity = 21;
        $Price = 345;
        $params = [
            "ProductID" => $ProductID,
            "ImageUrl" => $ImageUrl,
            "Price" => $Price,
            "Quantity" => $Quantity,
            "Description" => $Description
        ];


        $property->startTransaction();
        $actual = $property->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }

    public function testUpdateTitleXSS()
    {
        $property = new Property(new DBPDO());
        //data.      
        $ProductID = "43";
        $ImageUrl = "F:/github/Doan-NhomH/pictures/Upload/1110mcith_00000000000Nokia_6303i_b.jpg";
        $Description = "<a href=\"https://www.youtube.com/watch?v=eg91DX0f4z4\">NHấn vào đây để nhận được tiền từ từ thiện</a>";
        $Quantity = 21;
        $Price = 345;
        $params = [
            "ProductID" => $ProductID,
            "ImageUrl" => $ImageUrl,
            "Price" => $Price,
            "Quantity" => $Quantity,
            "Description" => $Description
        ];

        $property->startTransaction();
        $actual = $property->update($params);
        if ($actual) {
            $this->assertTrue(true);
        }
        $property->rollback();
    }
  
   
}
