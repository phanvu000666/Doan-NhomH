<?php
//UPDATE MODEL

require "./model/model.php";
require "Auth.php";
require "./model/phone.php";
require "./model/manufacture.php";
require "./model/category.php";
require "Component.php";

use SmartWeb\Phone;
use SmartWeb\Manufacture;
use SmartWeb\Category;
//ok
echo"fig bug";
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
