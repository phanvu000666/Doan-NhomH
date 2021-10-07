<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}pdo_con.php");

class Manufacture extends My_PDO
{
    function getNames()
    {
        $stmt = self::$conn->prepare("SELECT ManufacturerID, ManufacturerName FROM manufacturers");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
