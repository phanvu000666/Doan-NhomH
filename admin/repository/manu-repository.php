<?php

namespace SmartWeb\Repository;

use Manufacture;
use SmartWeb\DataBase\DBPDO;
use SmartWeb\Repository\Repository;
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}manufacture.php");
include_once "repository.php";

class ManufactureRepository implements Repository
{
    private static $manu;
    public static function getInstance()
    {
        if (empty($manu)) {
            static::$manu = Manufacture::getInstance(new DBPDO);
        }
        return self::$manu;
    }

    public static function select($sql, array $values = null)
    {
        return static::$manu->select($sql, $values);
    }
    public static function delete($sql, array $values = null)
    {
        return static::$manu->delete($sql, $values);
    }
}
