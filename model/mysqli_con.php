<?php

class My_MySQLI{
    public static  $conn;

    public function __construct()
    {
        self::$conn = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE);
        if (!self::$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully";
        
        return self::$conn;
    }
}
?>