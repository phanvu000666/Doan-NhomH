<?php

namespace SmartWeb;

require_once 'db.php';
require_once 'model.php';

class Profile extends Model
{
    private static Profile $_instance;
    protected static $con;
    public function __construct()
    {
        if (empty(static::$con))
            static::$con = ConnectMySqli::connect();
        return static::$con;
    }
    public static function getInstance()
    {
        if (empty(static::$_instance)) {
            self::$_instance = new self(new DBMYSQL);
        }
        return self::$_instance;
    }
    // Lấy user theo id
    public function getUsers()
    {
        return $this->db->select("SELECT * FROM users");
    }

    public function findUserById($id)
    {
        return $this->db->select("SELECT * FROM users where UserID = $id");
    }

    public function updateUsers($fullname, $email, $id)
    {
        $fullname    =  mysqli_real_escape_string(static::$con, $fullname);
        $email       =  mysqli_real_escape_string(static::$con, $email);
        $id          =  mysqli_real_escape_string(static::$con, $id);
        $sql = $this->db->select("UPDATE `users` SET `FullName`='$fullname',`Email`='$email' WHERE `UserId`='$id'");
        return $sql->execute();
    }
}
