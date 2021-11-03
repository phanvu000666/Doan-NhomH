<?php
// require "./model/config.php";
// require "./model/mysqli_con.php";
class Manufactures extends My_MySQLI{
//Phuong thuc lay data manufactures va chuyen tu object thanh array 
 public static function getInstance()
    {
        if(self::$_instance !== null){
            return self::$_instance;
        }
        self::$_instance = new self();
        return self::$_instance;
    }
    public function getManufactures(){
        $sql = self::$conn->prepare("SELECT * FROM manufacturers");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    } 
    public function getManufacturesByID($ManuID){
        $sql = self::$conn->prepare("SELECT * FROM manufacturers where ManufacturerID = $ManuID ");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getManuName($ManuID){
        $sql = self::$conn->prepare("SELECT * FROM manufacturers WHERE ManufacturerID = $ManuID");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}