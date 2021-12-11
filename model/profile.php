<?php

namespace SmartWeb;

require_once 'db.php';
require_once 'model.php';

class Profile extends Model
{
    private static Profile $_instance;
    public static function getInstance()
    {
        if (empty(static::$_instance)) {
            self::$_instance = new self(new DBMYSQL);
        }
        return self::$_instance;
    }

    public function findUserById($id)
    {
        return static::$_instance->db->select("SELECT * FROM users where UserID = $id");
    }

    public function updateUsers($fullname, $email, $id)
    {
        $fullname    =  htmlentities($fullname);
        $email       =  htmlentities($email);
        $id          =  htmlentities($id);
        $sql = static::$_instance->db->notselect("UPDATE `users` SET `FullName`='$fullname',`Email`='$email' WHERE `UserId`=$id");
        return $sql;
    }
    public function updatePass($password, $id)
    {
        $password = htmlentities($password);
        $id = htmlentities($id);
        $sql = static::$_instance->db->notselect("UPDATE `users` SET `PassWord`='$password' WHERE `UserId`=$id");
    }
}
