<?php
class Manufactures extends My_MySQLI{
//Phuong thuc lay data manufactures va chuyen tu object thanh array 
function getDataManufactures(){
    $sql = self::$conn->prepare("SELECT * FROM manufacturers");
    $sql->execute();
    $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    return $items;
    }
}