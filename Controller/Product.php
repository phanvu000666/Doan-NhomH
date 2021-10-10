<?php

require "./model/config.php";
require "./model/mysqli_con.php";

class Product extends My_MySQLI{
    function getDataDuaVaoID($id){
        $sql = self::$conn->prepare("SELECT * FROM `products` WHERE `products`.`ProductID` = `$id`");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
        
    }
    function getData(){
        //var_dump(self::$conn);
        $sql = self::$conn->prepare("SELECT * FROM products");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    function paginateSearch($key,$url, $total, $page, $perPage)
    {
        $totalLinks = ceil($total/$perPage);
        $link ="";
        for($j=1; $j <= $totalLinks ; $j++) $link = $link."<a href='$url?key=$key&page=$j'> $j </a>";
        return $link;
    }
    function getDataDuaVaoKeyChoBoxSerachCoPhanTrang($key,$page, $perPage){
        $firstLink = ($page - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM products WHERE name like '%$key%' LIMIT $firstLink, $perPage");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    function paginateForManu($id,$url, $total, $page, $perPage)
    {
        $totalLinks = ceil($total/$perPage);
        $link ="";
        for($j=1; $j <= $totalLinks ; $j++) $link = $link."<a href='$url?manu_id=$id&page=$j'> $j </a>";
        return $link;
    }
    function paginateForType($id,$url, $total, $page, $perPage)
    {
        $totalLinks = ceil($total/$perPage);
        $link ="";
        for($j=1; $j <= $totalLinks ; $j++) $link = $link."<a href='$url?type_id=$id&page=$j'> $j </a>";
        return $link;
    }
    function paginate($url, $total, $perPage)
{
    $totalLinks = ceil($total/$perPage);
 	    $link ="";
    	for($j=1; $j <= $totalLinks ; $j++)
     	{
      		$link = $link."<a href='$url?page=$j'> $j </a>";
     	}
    }
    function Search($keyword)
    {
        $key="%$keyword%";
        //var_dump(self::$conn);
        $sql = self::$conn->prepare("SELECT * FROM products WHERE ProductName  LIKE  ? ");
        $sql-> bind_param('s',$key);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        //var_dump($items);
        return $items; //return an array

    }
}