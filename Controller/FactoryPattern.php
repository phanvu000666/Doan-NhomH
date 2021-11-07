<?php
require "./model/model.php";
require "Auth.php";
require "./model/phone.php";
require "./model/manufacture.php";
require "./model/category.php";
require "Component.php";

use SmartWeb\Phone;
use SmartWeb\Manufacture;
use SmartWeb\Category;

class FactoryPattern
{
    public function make($model)
    {
        if ($model == 'auth') {
            return Auths::getInstance();
        } else if ($model == 'product') {
            return Phone::getInstance();
        } else if ($model == 'manufactures') {
            return Manufacture::getInstance();
        } else if ($model == 'category') {
            return Category::getInstance();
        } else if ($model == 'order') {
            return Order::getInstance();
        } else {
            return null;
        }
    }
}
// if user clicks on the forgot password button
if (isset($_POST['quenmatkhau'])){
    $email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email address is invalid";
}
if(empty($email)){
    $errors['email'] = "Email required";
}
if(count($errors) == 0){
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_fetch_assoc($result);
    $token = $user['token'];
    sendPasswordResetLink($email, $token);
    header('location: password_messege.php');
    exit(0);
}

}