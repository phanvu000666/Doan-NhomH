<?php

use PHPUnit\Framework\TestCase;
use SmartWeb\Models\User;
use SmartWeb\Models\Banner;

class UserTest extends TestCase
{

  // ================== Test "getInstance" method. ================== //

  // Trường hợp cái Instance được tạo ra có phải thuộc User model tạo không.
  public function testAssertInstanceOfUserClass()
  {
    $user = User::getInstance();
    $this->assertInstanceOf(User::class, $user);
  }

  // Trường hợp tạo 2 Instance có giống nhau không.
  public function testCompareTwoInstancesOk()
  {
    $user1 = User::getInstance();
    $user2 = User::getInstance();
    if ($user1 === $user2) {
      $this->assertTrue(true);
    } else {
      $this->assertTrue(false);
    }
  }

  // Trường hợp tạo 2 Instance có phải là 2 Instance khác nhau.
  public function testCompareTwoInstancesNg()
  {
    $user1 = User::getInstance();
    $banner = Banner::getInstance();

    if ($user1 === $banner) {
      $this->assertTrue(false);
    } else {
      $this->assertTrue(true);
    }
  }

  // ================== Test "updateUser" method. ================== //

  /**
   * Giá trị vào.
   */
  public function testUpdateUserWithParamIsNotArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Parameter is not array";
    $actual = $user->updateUser(null);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamIsEmptyArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Parameter empty";
    $actual = $user->updateUser([]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasArrayCountNotEqualSevenNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Number of input parameter is not accord";
    $actual = $user->updateUser([
      "one" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasKeyNameOfArrayNotMatchNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Number of input parameter is not accord";
    $actual = $user->updateUser([
      "keynotmatch" => "value",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /** Kiểu dữ liệu.
   * String
   * Integer
   * Float (floating point numbers - also called double)
   * Boolean
   * Array
   * Object
   * NULL
   */

  // Version
  public function testUpdateUserWithParamHasVersionValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Version is not numeric";
    $actual = $user->updateUser([
      "UserID" => 1,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => null,
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasVersionValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Version is not numeric";
    $actual = $user->updateUser([
      "UserID" => 1,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => Banner::getInstance(),
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasVersionValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Version is not numeric";
    $actual = $user->updateUser([
      "UserID" => 1,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => array(1, 2, 3),
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasVersionValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Version is not numeric";
    $actual = $user->updateUser([
      "UserID" => 1,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => false,
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasVersionValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Version must integer value";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1.2,
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasVersionValueOfArrayIsStringNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Version is not numeric";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => "string",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  // UserID
  public function testUpdateUserWithParamHasUserIdValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserID is not numeric";
    $actual = $user->updateUser([
      "UserID" => null,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserIdValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserID is not numeric";
    $actual = $user->updateUser([
      "UserID" => Banner::getInstance(),
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserIdValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserID is not numeric";
    $actual = $user->updateUser([
      "UserID" => array(1, 2, 3),
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserIdValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserID is not numeric";
    $actual = $user->updateUser([
      "UserID" => false,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserIdValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserID must integer value";
    $actual = $user->updateUser([
      "UserID" => 1.2,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserIdValueOfArrayIsStringNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserID is not numeric";
    $actual = $user->updateUser([
      "UserID" => "string",
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }


  // FullName
  public function testUpdateUserWithParamHasFullNameValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => null,
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasFullNameValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => Banner::getInstance(),
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasFullNameValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => array(1, 2, 3),
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasFullNameValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => false,
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasFullNameValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => 1.2,
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasFullNameValueOfArrayIsIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => 1,
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  // UserName
  public function testUpdateUserWithParamHasUserNameValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => null,
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserNameValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => Banner::getInstance(),
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserNameValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => array(1, 2, 3),
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserNameValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => false,
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserNameValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => 1.2,
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUserNameValueOfArrayIsIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => 1,
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }


  // PassWord
  public function testUpdateUserWithParamHasPasswordValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => null,
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasPasswordValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => Banner::getInstance(),
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasPasswordValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => array(1, 2, 3),
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasPasswordValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => false,
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasPasswordValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => 1.2,
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasPasswordValueOfArrayIsIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => 1,
      "Email" => "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  // Email
  public function testUpdateUserWithParamHasEmailValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  null,
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasEmailValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  Banner::getInstance(),
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasEmailValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  array(1, 2, 3),
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasEmailValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  false,
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasEmailValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  1.2,
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasEmailValueOfArrayIsIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  1,
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   * Độ dài giá trị.
   */

  public function testUpdateUserWithParamHasFullNameValueOfArrayWithLengthBetween6And120Ng()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName must be between 6 and 120";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "2word",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasUsernameValueOfArrayWithLengthBetween6And120Ng()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName must be between 6 and 120";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "2word",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }


  public function testUpdateUserWithParamHasPasswordValueOfArrayWithLengthBetween6And120Ng()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord must be between 6 and 120";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "2word",
      "Email" =>  "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testUpdateUserWithParamHasEmailValueOfArrayWithLengthBetween6And120Ng()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email must be between 6 and 120";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "2word",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  xác nhận email phù hợp.
   */

  public function testUpdateUserWithParamHasEmailValueOfArrayIsCorrectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not valid";
    $actual = $user->updateUser([
      "UserID" => 6214999198,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "2words",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  xác nhận Là số nguyên lớn hơn 0.
   */

  public function testUpdateUserWithParamHasUserIdValueOfArrayIsPositiveIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserID must greater than 0";
    $actual = $user->updateUser([
      "UserID" => -4806994762,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }


  /**
   *  xác nhậnnhận Là số nguyên lớn hơn 0.
   */

  public function testUpdateUserWithParamHasVersionValueOfArrayIsPositiveIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Version must greater than 0";
    $actual = $user->updateUser([
      "UserID" => 4806994762,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "leanhvu2104@gmail.com",
      "Version" => -4806994762
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }


  /**
   *  xác nhận không tìm thấy id phù hợp trên database.
   */

  public function testUpdateUserWithParamHasUserIdValueOfArrayIsNotFoundInDatabaseNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserID is not exist";
    $actual = $user->updateUser([
      "UserID" => 4806994762123121,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }



  /**
   *  Version cũ, mới.
   */

  public function testUpdateUserWithParamHasVersionValueOfArrayIsNotMatchOnDatabaseNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Please reload page and try again.";
    $actual = $user->updateUser([
      "UserID" => 7148998843,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "leanhvu2104@gmail.com",
      "Version" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  Trùng email khác.
   * // chú y phải phù hợp version. và UserID.
   * 
   * Mã số : 8362178255
   */

  public function testUpdateUserWithParamHasEmailValueOfArrayIsMatchWithOtherEmailNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is exist";
    $actual = $user->updateUser([
      "UserID" => 7148998843,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "admin@gmail.com",
      "Version" => 8362178255
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  Trùng UserName khác.
   * // chú y phải phù hợp version.
   */


  public function testUpdateUserWithParamHasUsernameValueOfArrayIsMatchWithOtherUsernameNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is exist";
    $actual = $user->updateUser([
      "UserID" => 7148998843,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "administratortest",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "test@gmail.com",
      "Version" => 8362178255
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  Password không đúng.
   */


  public function testUpdateUserWithParamHasPasswordValueOfArrayIsNotAccordNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter, one number and one special character";
    $actual = $user->updateUser([
      "UserID" => 7148998843,
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "adminiest",
      "PassWord" => "lav123",
      "Email" =>  "test@gmail.com",
      "Version" => 8362178255
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  Groups không tìm thấy.
   */


  public function testUpdateUserWithParamHasGroupNameValueOfArrayIsNotAccordNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = 'Group not found';
    $actual = $user->updateUser([
      "UserID" => 7148998843,
      "GroupName" => "Adminaaa",
      "FullName" => "leanhvu2104",
      "UserName" => "adminiest",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "test@gmail.com",
      "Version" => 8362178255
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  // public function testUpdateUserWithParamHasValueOfArrayAreSpecialCharactersNg()
  // {
  //   $user = User::getInstance();
  //   $user->startTransaction();

  //   $expected = true;
  //   $actual = $user->updateUser([
  //     "UserID" => 7148998843,
  //     "GroupName" => "Admin",
  //     "FullName" => "';######",
  //     "UserName" => "adminiest",
  //     "PassWord" => "LeAnhVu2104@",
  //     "Email" =>  "test@gmail.com",
  //     "Version" => 8362178255
  //   ]);

  //   if ($actual == $expected) {
  //     $this->assertTrue(true);
  //   } else {
  //     $this->assertTrue(false);
  //   }

  //   $user->rollBack();
  // }


  // ================== Test "addUser" method. ================== //



  /**
   * Giá trị vào.
   */
  public function testAddUserWithParamIsNotArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Parameter is not array";
    $actual = $user->addUser(null);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamIsEmptyArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Parameter empty";
    $actual = $user->addUser([]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasArrayCountNotEqualSevenNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Number of input parameter is not accord";
    $actual = $user->addUser([
      "one" => 1
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasKeyNameOfArrayNotMatchNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Number of input parameter is not accord";
    $actual = $user->addUser([
      "keynotmatch" => "value",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /** Kiểu dữ liệu.
   * String
   * Integer
   * Float (floating point numbers - also called double)
   * Boolean
   * Array
   * Object
   * NULL
   */

  // FullName
  public function testAddUserWithParamHasFullNameValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => null,
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasFullNameValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => Banner::getInstance(),
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasFullNameValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => array(1, 2, 3),
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasFullNameValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => false,
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasFullNameValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => 1.2,
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasFullNameValueOfArrayIsIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => 1,
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  // UserName
  public function testAddUserWithParamHasUserNameValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => null,
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasUserNameValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => Banner::getInstance(),
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasUserNameValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => array(1, 2, 3),
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasUserNameValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => false,
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasUserNameValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => 1.2,
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasUserNameValueOfArrayIsIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => 1,
      "PassWord" => "LeAnhVu2104@",
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }


  // PassWord
  public function testAddUserWithParamHasPasswordValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => null,
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasPasswordValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => Banner::getInstance(),
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasPasswordValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => array(1, 2, 3),
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasPasswordValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => false,
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasPasswordValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => 1.2,
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasPasswordValueOfArrayIsIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => 1,
      "Email" => "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  // Email
  public function testAddUserWithParamHasEmailValueOfArrayIsNullNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  null,
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasEmailValueOfArrayIsObjectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  Banner::getInstance(),
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasEmailValueOfArrayIsArrayNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  array(1, 2, 3),
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasEmailValueOfArrayIsBooleanNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  false,
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasEmailValueOfArrayIsFloatNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  1.2,
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasEmailValueOfArrayIsIntegerNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not string";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  1,
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   * Độ dài giá trị.
   */

  public function testAddUserWithParamHasFullNameValueOfArrayWithLengthBetween6And120Ng()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "FullName must be between 6 and 120";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "2word",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasUsernameValueOfArrayWithLengthBetween6And120Ng()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName must be between 6 and 120";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "2word",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }


  public function testAddUserWithParamHasPasswordValueOfArrayWithLengthBetween6And120Ng()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "PassWord must be between 6 and 120";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "2word",
      "Email" =>  "leanhvu2104@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasEmailValueOfArrayWithLengthBetween6And120Ng()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email must be between 6 and 120";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "2word",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  xác nhận email phù hợp.
   */

  public function testAddUserWithParamHasEmailValueOfArrayIsCorrectNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is not valid";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "2words",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  Trùng email khác.
   * // chú y phải phù hợp version. và UserID.
   * 
   * Mã số : 8362178255
   */

  public function testAddUserWithParamHasEmailValueOfArrayIsMatchWithOtherEmailNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Email is exist";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "leanhvu2104sdf",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "admin@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  Trùng UserName khác.
   * // chú y phải phù hợp version.
   */


  public function testAddUserWithParamHasUsernameValueOfArrayIsMatchWithOtherUsernameNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "UserName is exist";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "administratortest",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "test@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  Password không đúng.
   */


  public function testAddUserWithParamHasPasswordValueOfArrayIsNotAccordNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = "Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter, one number and one special character";
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "leanhvu2104",
      "UserName" => "adminies123t",
      "PassWord" => "lav123",
      "Email" =>  "tessdft@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  /**
   *  Groups không tìm thấy.
   */


  public function testAddUserWithParamHasGroupNameValueOfArrayIsNotAccordNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = 'Group not found';
    $actual = $user->addUser([
      "GroupName" => "Adminaaa",
      "FullName" => "leanhvu2104",
      "UserName" => "adminiesd1d12t",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "tes12et@gmail.com",
    ]);

    $this->assertEquals($expected, $actual);

    $user->rollBack();
  }

  public function testAddUserWithParamHasValueOfArrayAreSpecialCharactersNg()
  {
    $user = User::getInstance();
    $user->startTransaction();

    $expected = true;
    $actual = $user->addUser([
      "GroupName" => "Admin",
      "FullName" => "';######",
      "UserName" => "adminiest",
      "PassWord" => "LeAnhVu2104@",
      "Email" =>  "test@gmail.com",
    ]);

    if ($actual == $expected) {
      $this->assertTrue(true);
    } else {
      $this->assertTrue(false);
    }

    $user->rollBack();
  }


  // ================== Test "getListUser" method. ================== //

  // ================== Test "getFormUserInfo" method. ================== //

  // ================== Test "deleteUser" method. ================== //

  // ================== Test "getGroups" method. ================== //

}
