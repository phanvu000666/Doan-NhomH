<?php

abstract class Base
{
    protected static $temp = null;
    function __construct()
    {
        self::$temp = null;
    }
}

class User extends Base
{
    static function  print()
    {
        if (static::$temp == null) {
            static::$temp = "user";
        }
        echo static::$temp;
    }
}

class Bank extends Base
{
    static function print()
    {
        if (static::$temp == null) {
            static::$temp = "bank";
        }
        echo static::$temp;
    }
}

User::print();
Bank::print();
