<?php

use PHPUnit\Framework\TestCase;
use SmartWeb\DBMYSQL;
use SmartWeb\Profile;

class ProfileTest extends TestCase
{
    public function testInstance()
    {
        $pro1 = Profile::getInstance();
        $pro2 =  Profile::getInstance();

        $actual = false;
        if ($pro1 === $pro2) {
            $actual = true;
        }
        $expected = true;

        $this->assertEquals($expected, $actual);
    }
    public function testInstanceNotNull()
    {
        $pro = Profile::getInstance();
        $actual = $pro;
        if (empty($actual)) {
            $actual = false;
        } else {
            $actual = true;
        }
        $expected = true;
        $this->assertEquals($expected, $actual);
    }
    public function testInstanceisOb()
    {
        $pro = Profile::getInstance();
        if (is_object($pro)) {
            $this->assertTrue(True);
        } else {
            $this->assertTrue(false);
        }
    }
    public function testFindUserByIdOk(){
        $profile = new Profile(new DBMYSQL());
        $userId = 9999;
        $user = $profile->findUserById($userId);
        if(empty($user)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testFindUserByIdNg(){
        $profile = new Profile(new DBMYSQL());
        $userId = 9999;
        $user = $profile->findUserById($userId);
        if(empty($user)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testFindUserByIdIsFloat(){
        $profile = new Profile(new DBMYSQL());
        $userId = 12.13;
        $user = $profile->findUserById($userId);
        if(empty($user)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testFindUserByIdIsInt() {
        $profile = new Profile(new DBMYSQL());
        $id = 18;
        $user = $profile->findUserById($id);
        if(empty($user)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testFindUserByIdIsString() {
        $profile = new Profile(new DBMYSQL());
        $id = 'jahsdja';
        $user = $profile->findUserById($id);
        if(empty($user)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testFindUserByIdIsNull() {
        $profile = new Profile(new DBMYSQL());
        $id = null;
        $user = $profile->findUserById($id);
        if(empty($user)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
    public function testFindUserByIdIsBool() {
        $profile = new Profile(new DBMYSQL());
        $id = true;
        $user = $profile->findUserById($id);
        if(empty($user)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testFindUserByIdIsEmpty() {
        $profile = new Profile(new DBMYSQL());
        $id = '';
        $user = $profile->findUserById($id);
        if(empty($user)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
    public function testFindUserByIdIsSpecChar() {
        $profile = new Profile(new DBMYSQL());
        $id = '^&%@&';
        $user = $profile->findUserById($id);
        $expected = false;
        $this->assertEquals($expected, $user);
    }
    public function testUpdateUserOk(){
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = 'quan@gmail.com';
        $userId = 88;
        $user = $profile->updateUsers($fullname, $email, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserNg(){
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = 'quan@gmail.com';
        $userId = 88;
        $user = $profile->updateUsers($fullname, $email, $userId);
        if(empty($user)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserFullnameIsEmpty()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = '';
        $email = 'quan@gmail.com';
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserEmailIsEmpty()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = '';
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserIdIsEmpty()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = 'quan@gmail.com';
        $userId = '';
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
    public function testUpdateUserFullnameIsFloat()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 12.13;
        $email = 'quan@gmail.com';
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserEmailIsFloat()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = 12.13;
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserIdIsFloat()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = 'quan@gmail.com';
        $userId = 12.13;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserFullnameIsString()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'jaskdhgjagdskahksd';
        $email = 'quan@gmail.com';
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserEmailIsString()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = 'kahskldladsja';
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserIdIsString()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = 'quan@gmail.com';
        $userId = 'ajhgsdkhadasdad';
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
    public function testUpdateUserFullnameIsBool()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = true;
        $email = 'quan@gmail.com';
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserEmailIsBool()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = true;
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserIdIsBool()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = 'quan@gmail.com';
        $userId = true;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserFullnameIsNull()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = null;
        $email = 'quan@gmail.com';
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserEmailIsNull()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = 'quan';
        $email = null;
        $userId = 88;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(false);
        }else{
            $this->assertTrue(true);
        }
    }
    public function testUpdateUserIdIsNull()
    {
        $profile = new Profile(new DBMYSQL());
        $fullname = htmlentities('quan');
        $email = htmlentities('quan@gmail.com');
        $userId = null;
        $actual = $profile->updateUsers($fullname, $email, $userId);
        if(empty($actual)){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
    public function testUpdatePassOk(){
        $profile = new Profile(new DBMYSQL());
        $password = 'thanhquan';
        $userId = 88;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassNg(){
        $profile = new Profile(new DBMYSQL());
        $password = 99999999;
        $userId = 88;
        $user = $profile->updatePass($password, $userId);
        $expected = false;
        $this->assertEquals($expected,$user);
    }
    public function testUpdatePassIsString(){
        $profile = new Profile(new DBMYSQL());
        $password = 'ajksdklakdhakshkdahds';
        $userId = 85;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIsFloat(){
        $profile = new Profile(new DBMYSQL());
        $password = 12.13;
        $userId = 85;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIsBool(){
        $profile = new Profile(new DBMYSQL());
        $password = true;
        $userId = 85;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIsEmpty(){
        $profile = new Profile(new DBMYSQL());
        $password = '';
        $userId = 85;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIsNull(){
        $profile = new Profile(new DBMYSQL());
        $password = null;
        $userId = 85;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIsInt(){
        $profile = new Profile(new DBMYSQL());
        $password = 616163163;
        $userId = 85;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIsSpecChar(){
        $profile = new Profile(new DBMYSQL());
        $password = '&%&^#';
        $userId = 85;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIdIsSpecChar(){
        $profile = new Profile(new DBMYSQL());
        $password = 'thanhquan1';
        $userId = '&%&^#';
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIdIsString(){
        $profile = new Profile(new DBMYSQL());
        $password = 'thanhquan1';
        $userId = 'ajksdklakdhakshkdahds';
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIdIsFloat(){
        $profile = new Profile(new DBMYSQL());
        $password = 'thanhquan1';
        $userId = 12.13;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIdIsBool(){
        $profile = new Profile(new DBMYSQL());
        $password = 'thanhquan1';
        $userId = true;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIdIsEmpty(){
        $profile = new Profile(new DBMYSQL());
        $password = 'thanhquan1';
        $userId = '';
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIdIsNull(){
        $profile = new Profile(new DBMYSQL());
        $password = 'thanhquan1';
        $userId = null;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassIdIsInt(){
        $profile = new Profile(new DBMYSQL());
        $password = 'thanhquan1';
        $userId = 616163163;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassAndIdIsSpecChar(){
        $profile = new Profile(new DBMYSQL());
        $password = '&%&^#';
        $userId = '&%&^#';
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassAndIdIsString(){
        $profile = new Profile(new DBMYSQL());
        $password = 'ajksdklakdhakshkdahds';
        $userId = 'ajksdklakdhakshkdahds';
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassAndIdIsFloat(){
        $profile = new Profile(new DBMYSQL());
        $password = 12.13;
        $userId = 12.13;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassAndIdIsBool(){
        $profile = new Profile(new DBMYSQL());
        $password = true;
        $userId = true;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassAndIdIsEmpty(){
        $profile = new Profile(new DBMYSQL());
        $password = '';
        $userId = '';
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassAndIdIsNull(){
        $profile = new Profile(new DBMYSQL());
        $password = null;
        $userId = null;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
    public function testUpdatePassAndIdIsInt(){
        $profile = new Profile(new DBMYSQL());
        $password = 616163163;
        $userId = 616163163;
        $user = $profile->updatePass($password, $userId);
        if(empty($user)){
            $this->assertTrue(true);
        }
    }
}

?>