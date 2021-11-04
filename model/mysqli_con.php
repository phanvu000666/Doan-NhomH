<?php
class My_MySQLI{
    protected static $_instance;
    public static  $conn;
    public function __construct()
    {
        self::$conn = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE);
        if (!self::$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        return self::$conn;
    }
    public static function select($sql)
    {
        $items = [];
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    protected function selects($sql) {
        $result = $this->query($sql);
        $rows = [];
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    protected function query($sql) {
        $result = self::$conn->query($sql);
        return $result;
    }
    /**
     * Delete statement
     * @param $sql
     * @return mixed
     */
    protected function delete($sql) {
        $result = $this->query($sql);
        return $result;
    }

    /**
     * Update statement
     * @param $sql
     * @return mixed
     */
    protected function update($sql) {
        $result = $this->query($sql);
        return $result;
    }

    /**
     * Insert statement
     * @param $sql
     */
    protected function insert($sql) {
        $result = $this->query($sql);
        return $result;
    }
  
}
