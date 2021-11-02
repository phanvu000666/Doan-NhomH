<?php
class Manufactures extends My_MySQLI{
//Phuong thuc lay data manufactures va chuyen tu object thanh array 
    function getManufactures(){
        $sql = self::$conn->prepare("SELECT * FROM manufacturers");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    } 
    function getManufacturesByID($ManuID){
        $sql = self::$conn->prepare("SELECT * FROM manufacturers where ManufacturerID = $ManuID ");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    function getManuName($ManuID){
        $sql = self::$conn->prepare("SELECT * FROM manufacturers WHERE ManufacturerID = $ManuID");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}