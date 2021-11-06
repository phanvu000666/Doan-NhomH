<?php
//UPDATE MODEL
use SmartWeb\DBMYSQL;
use SmartWeb\Model;

class AddToCart extends Model
{
    private static AddToCart $_instance;
    public static function getInstance()
    {
        if (empty($_instance)) {
            self::$_instance = new self(new DBMYSQL);
        }
        return self::$_instance;
    }
}
