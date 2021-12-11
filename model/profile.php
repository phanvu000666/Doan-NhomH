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
    // Lấy user theo id
    public function getUsers()
    {
        return $this->db->select("SELECT * FROM users");
    }

    public function findUserById($id) {
        return $this->db->select("SELECT * FROM users where UserID = $id");
    }

    public function updateUsers($fullname, $email, $username){
        $fullname    =  escape($_POST['fullname']);
	$email       =  escape($_POST['email']);
	$username          =  escape($_POST['info']);
        $sql = $this->db->select("UPDATE `users` SET `FullName`='$fullname',`Email`='$email' WHERE `UserName`='$username'");
        return $sql->execute();
    }
}
?>