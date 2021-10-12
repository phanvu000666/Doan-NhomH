<?php
require "./model/config.php";
require "./model/mysqli_con.php";
class Product extends My_MySQLI{
    function getDataDuaVaoID($id){
        $sql = self::$conn->prepare("SELECT * FROM products WHERE ProductID = $id");
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
    public function getTotalRow()
    {
        $sql = parent::$conn->prepare("SELECT COUNT(ProductID) FROM products");
        return parent::select($sql)[0]['COUNT(ProductID)'];
    }
    function getAllProducts($page, $perPage){
        // Tính số thứ tự trang bắt đầu
        $start = $perPage * ($page - 1);
        //2. Viết câu SQL
        $sql = parent::$conn->prepare("SELECT * FROM products LIMIT ?, ?");
        $sql->bind_param('ii', $start, $perPage);
        return parent::select($sql);
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
    function getTotal(){
        $idUser = $_SESSION['id_user'];
        $sql = self::$conn->prepare("SELECT * FROM `orders` INNER JOIN products on products.ProductID = orders.id_product  WHERE orders.id_user = $idUser");
        $sql->execute();
        $items = array();
        $total = 0;
        $count = 0;
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach ($items as $key => $value){
            $count+=1;
            $total = $total + $items[$key]['quantity']*$items[$key]['Price'];
        }  
        return [$total, $count];
    }
}