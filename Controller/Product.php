<?php
require "./model/config.php";
require "./model/mysqli_con.php";

class Product extends My_MySQLI{
    function getDataDuaVaoID($id){
        $sql = self::$connection->prepare("SELECT * FROM products WHERE ProductID = $id");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
        
    }
    function getSPNoiBat(){
        $sql = self::$conn->prepare("SELECT * FROM products WHERE feature = 1");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
        
    }
    function getAllProducts($page, $perPage){
        // Tính số thứ tự trang bắt đầu
        $firstLink = ($page - 1) * $perPage;
        //Dùng LIMIT để giới hạn số lượng hiển thị 1 trang
        $sql = self::$conn->prepare("SELECT * FROM products LIMIT ?, ? ");
        $sql->bind_param('ii',$page, $perPage); //sql injection.
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    //Viet phuong th
    function getData(){
        $sql = self::$conn->prepare("SELECT * FROM products");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    function paginate($url, $total, $page, $perPage)
    {
        $totalLinks = ceil($total/$perPage);
        $link ="";
        for($j=1; $j <= $totalLinks ; $j++) $link = $link."<a href='$url?page=$j'> $j </a>";
        return $link;
    }
}