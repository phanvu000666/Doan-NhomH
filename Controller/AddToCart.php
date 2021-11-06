<?php
//UPDATE MODEL
use SmartWeb\Model;
 //ok
 echo"fig bug";
class AddToCart extends Model
{
    private static AddToCart $_instance;
    public static function getInstance()
    {
        if (self::$_instance !== null) {
            return self::$_instance;
        }
        self::$_instance = new self(static::$db);
        return self::$_instance;
    }
}
