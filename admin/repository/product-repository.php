<?php

namespace SmartWeb\Repository;

use ProductRepository as pr;
use SmartWeb\DataBase\DBPDO;
use SmartWeb\Repository\Repository;
use SmartWeb\DataBase\Product\Phone;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}product.php");
include_once "repository.php";

class ProductRepository implements Repository
{
    private static $phone;
    public static function getInstance()
    {
        if (empty($phone)) {
            static::$phone = Phone::getInstance(new DBPDO);
        }
        return self::$phone;
    }

    public static function select($sql, array $values = null)
    {
        return static::$phone->select($sql, $values);
    }
    public static function delete($sql, array $values = null)
    {
        return static::$phone->delete($sql, $values);
    }
}
