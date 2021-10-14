<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}pdo_con.php");

class Category extends My_PDO
{
    private static $category;

    public static function getInstance()
    {
        if (self::$category) {
            return self::$category;
        }
        self::$category = new self();
        return self::$category;
    }
    function getNames()
    {
        $stmt = parent::getInstance()->prepare("SELECT CategoryID, CategoryName FROM categories");
        $stmt->execute();
        $result = array();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
