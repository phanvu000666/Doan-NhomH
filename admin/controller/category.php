<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}pdo_con.php");
class Category extends My_PDO
{
    function getNames()
    {
        $stmt = self::$conn->prepare("SELECT CategoryID, CategoryName FROM categories");
        $stmt->execute();
        $result = array();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
