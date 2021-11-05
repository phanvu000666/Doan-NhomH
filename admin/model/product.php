<?php

namespace SmartWeb\DataBase\Product;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}db.php");

use SmartWeb\DataBase\Connect;
use SmartWeb\DataBase\DB;
use SmartWeb\DataBase\DBMYSQL;
use SmartWeb\DataBase\DBPDO;

abstract class Model
{
   protected DB $db;
   protected function __construct(DB $db)
   {
      $this->db = $db;
   }
}

class Phone extends Model
{
   private static Phone $phone;
   public static function getInstance(DB $db)
   {
      if (empty($phone)) {
         self::$phone = new self($db);
      }
      return self::$phone;
   }

   public function select($sql, array $param = null)
   {
      return $this->db->select($sql, $param);
   }

   public function delete($sql, array $param = null)
   {
      return $this->db->delete($sql, $param);
   }
}
