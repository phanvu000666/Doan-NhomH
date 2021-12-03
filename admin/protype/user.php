<?php

namespace SmartWeb\Models;
class User
{
    #[InjectConstructor(DB::class)]
    public function __construct(protected DB $db)
    {
        $this->db =  $db;
    }

    public function getUser(){
        $sql = "SELECT MAX(UserID) UserID FROM users";
        $id_current_user = $this->db->select($sql);
        $id_user = $id_current_user[0]['UserID'];
        return $id_user;
    }
}
