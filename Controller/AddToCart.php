<?php
//UPDATE MODEL
use SmartWeb\Model;

class AddToCart extends Model
{
    private static AddToCart $_instance;
    public static function getInstance()
    {
        if(self::$_instance !== null){
            return self::$_instance;
        }
        self::$_instance = new self();
        return self::$_instance;
    }
}