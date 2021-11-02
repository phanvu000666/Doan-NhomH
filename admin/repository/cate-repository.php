<?php

namespace SmartWeb\Repository;

use Category;
use SmartWeb\DataBase\DBPDO;
use SmartWeb\Repository\Repository;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}manufacture.php");
include_once "repository.php";

class CategoryRepository implements Repository
{
    private static $cate;
    public static function getInstance()
    {
        if (empty($cate)) {
            static::$cate = Category::getInstance(new DBPDO);
        }
        return static::$cate;
    }

    public static function select($sql, array $values = null)
    {
        return static::$cate->select($sql, $values);
    }
    public static function delete($sql, array $values = null)
    {
        return static::$cate->delete($sql, $values);
    }
}
