<?php

abstract class My_MySQLI
{
    private static  $conn;

    public function __construct()
    {
        self::$conn = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE);
        if (!self::$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // echo "Connected successfully";
        // return self::$conn;
    }

    public static function getInstance()
    {
        if (self::$conn) {
            return self::$conn;
        }
        $conn = new self();
        return $conn;
    }
}
