<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}pdo_con.php");
class Product extends My_PDO
{
    function getInfor()
    {
        $stmt = self::$conn->prepare("SELECT ProductID,ProductName, Price, `Description` FROM products");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function deleteProduct($id)
    {
        $stmt = self::$conn->prepare("DELETE FROM products WHERE ProductID = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
