<?php

class My_MySQLI{
    public static  $conn;

    public function __construct()
    {
        self::$conn = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE);
        if (!self::$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        return self::$conn;
    }
    public function select($sql)
    {
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}
?>