<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}pdo_con.php");

class Manufacture extends My_PDO
{
    private static $manufacture;
    public static function getInstance()
    {
        if (self::$manufacture) {
            return self::$manufacture;
        }
        self::$manufacture = new self();
        return self::$manufacture;
    }
    function getNames()
    {
        $stmt = parent::getInstance()->prepare("SELECT ManufacturerID, ManufacturerName FROM manufacturers");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
