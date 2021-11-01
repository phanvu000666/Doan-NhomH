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
    public static function select($sql)
    {
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public static function FetchAll($sql)
    {
        $arr=array();
        $r = $this->ExecuteQuery($sql);
        while ($row = mysqli_fetch_assoc($r)) {
            $arr[]=$row;
        }
        mysqli_free_result($r);
        return $arr;
    }
  
}
