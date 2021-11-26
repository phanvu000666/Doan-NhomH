<?php

namespace SmartWeb\Controller;

use SmartWeb\DataBase\Product\Model;
use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Models\Phone;
use SmartWeb\File\Upload;
use SmartWeb\Models\Product;
use SmartWeb\Models\User;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}include{$ds}function.php");
include_once("{$base_dir}model{$ds}update-file.php");

class UserController
{
    private User $user;
    public function __construct(string $conf)
    {
        $assembler = new ObjectAssembler($conf);
        $this->user = $assembler->getComponent(User::class);
    }
    
   public function showUserData(){
       $this->user->getUser();
       var_dump($this->user->getUser());
   }
}