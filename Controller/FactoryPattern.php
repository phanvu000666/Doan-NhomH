<?php
require "./model/config.php";
require "./model/mysqli_con.php";
require "Auth.php";
require "Product.php";
require "Manufacturers.php";
require "Order.php";
require "Category.php";
require "Component.php";

class FactoryPattern{
    public function make($model){
        if($model == 'auth'){
        return Auths::getInstance();
        } else if($model == 'product'){
            return Product::getInstance();  
        } else if($model == 'manufactures'){
            return Manufactures::getInstance();  
        } else if($model == 'category'){
            return Category::getInstance();  
        } else if($model == 'order'){
            return Order::getInstance();        
        } else {
            return null;
        }
    }
}
