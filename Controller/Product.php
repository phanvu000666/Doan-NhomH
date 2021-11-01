<?php
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
    function getSPNew(){
        $sql = self::$conn->prepare( "SELECT * FROM products ORDER BY ProductID DESC");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
        
    }
    function get3SPNew(){
        $sql = self::$conn->prepare( "SELECT * FROM products ORDER BY ProductID DESC LIMIT 3");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
        
    }
    function getProductsByCateID($cateID){
        $sql = self::$conn->prepare("SELECT * FROM products WHERE CategoryID = $cateID");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
        
    }
    function getProductsByManuID($manuID){
        $sql = self::$conn->prepare("SELECT * FROM products WHERE ManufacturerID = $manuID");
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

    //==================
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

    public function countAll(){
        $sql = "SELECT * FROM products";
        $result = self::$conn->query($sql);
        return $result->num_rows;
    }
    function Search_Paginate($start, $litmit,$keyword){
        $key="%$keyword%";
        $sql = self::$conn->prepare("SELECT * FROM products WHERE ProductName  LIKE  ? LIMIT $start,$litmit");
        $sql-> bind_param('s',$key);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getID(){
        $sql = $sql = self::$conn->prepare("SELECT ProductID FROM `products`");
        $sql->execute();//return an object
        $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result; //return an array

    }
}