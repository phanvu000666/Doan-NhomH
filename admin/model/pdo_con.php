<?php
require 'config.php';
class My_PDO
{
    public static  $conn;

    public function __construct()
    {
        try {
            self::$conn = new PDO("mysql:host=" . SEVERNAME . ";dbname=" . DATABASE, USERNAME, PASSWORD);
           // echo "Connected to " . DATABASE . " at " . SEVERNAME . "successfully.";
        } catch (PDOException $pe) {
            die("Could not connect to the database" . DATABASE . " :" . $pe->getMessage());
        }
        return self::$conn;
    }
}
