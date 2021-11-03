<?php
// require "./model/config.php";
// require "./model/mysqli_con.php";

class Order extends My_MySQLI {
    public static function getInstance()
    {
        if(self::$_instance !== null){
            return self::$_instance;
        }
        self::$_instance = new self();
        return self::$_instance;
    }
    function getDataOrder() {
        $idUser = $_SESSION['id_user'];
        var_dump($idUser);
        $sql = self::$conn->prepare("SELECT * FROM `orders` INNER JOIN products on products.ProductID = orders.id_product  WHERE orders.id_user = $idUser");
        $sql->execute();//return an object
        //var_dump($sql);
        $items = [];
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        return $items; //return an array
    }

    function changeQuantity($number, $id) {
        $sql = self::$conn->query("UPDATE `orders` SET `quantity`= $number WHERE  `orders`.`id`= $id");
    }

    function deleteOrder($id) {
        $sql = self::$conn->query("DELETE FROM `orders` WHERE `orders`.`id`= $id");
    }

    function addOrder($id) {
        $idUser = $_SESSION['id_user'];
        $sql    = self::$conn->prepare("SELECT * FROM `orders` INNER JOIN products on products.ProductID = orders.id_product  WHERE orders.id_user = $idUser");
        $sql->execute();//return an object
        $items    = [];
        $items    = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        $check    = 0;
        $number   = 0;
        $id_order = 0;
        foreach ($items as $key => $value) {
            if ($items[$key]['id_product'] == $id) {
                $check    = 1;
                $number   = $items[$key]['quantity'] + 1;
                $id_order = $items[$key]['id'];
            }
        }
        if ($check == 1) {
            $sql = self::$conn->query("UPDATE `orders` SET `quantity`= $number WHERE  `orders`.`id`= $id_order");
        } else {
            $sql = self::$conn->query("INSERT INTO `orders`(`id_user`, `id_product`, `quantity`) VALUES ( $idUser, $id, 1)");
        }
    }

    function getTotal() {
        $idUser = $_SESSION['id_user'];
        $sql    = self::$conn->prepare("SELECT * FROM `orders` INNER JOIN products on products.ProductID = orders.id_product  WHERE orders.id_user = $idUser");
        $sql->execute();//return an object
        $items = [];
        $total = 0;
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach ($items as $key => $value) {
            $total = $total + $items[$key]['quantity'] * $items[$key]['Price'];
        }

        return $total;
    }

    function getData() {
        $sql = self::$conn->prepare("SELECT * FROM products");
        $sql->execute();//return an object
        $items = [];
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

}

?>