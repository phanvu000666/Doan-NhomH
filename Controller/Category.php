<?php
class Category extends My_MySQLI{
//Phuong thuc lay data manufactures va chuyen tu object thanh array 
    function getCategory(){
        $sql = self::$conn->prepare("SELECT * FROM categories");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
     }
    function getCategoryByID($cateID){
        $sql = self::$conn->prepare("SELECT * FROM categories WHERE CategoryID = $cateID");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
     function getCateName($cateID){
        $sql = self::$conn->prepare("SELECT * FROM categories WHERE CategoryID = $cateID");
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

}