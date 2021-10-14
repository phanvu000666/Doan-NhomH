<?php
require 'config.php';
abstract class My_PDO
{
    private static  $conn;

    public function __construct()
    {
        try {
            self::$conn = new PDO("mysql:host=" . SEVERNAME . ";dbname=" . DATABASE, USERNAME, PASSWORD);
            // echo "Connected to " . DATABASE . " at " . SEVERNAME . "successfully.";
        } catch (PDOException $pe) {
            die("Could not connect to the database" . DATABASE . " :" . $pe->getMessage());
        }
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
